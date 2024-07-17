<?php
session_start();
require_once 'Log.php';

class User {

    public function __construct() {

    }

    public function authenticate($username, $password) {
        $username = strtolower($username);

        if (empty($username) || empty($password)) {
            $_SESSION["loginError"] = 'All fields are required';
            header("Location: /login");
            die;
        }

        $db = db_connect();
        $logModel = new Log();
        $user_attempts = $logModel->getFailedAttempts($username);

        if ($user_attempts['failed_attempts'] >= 3) {
            $_SESSION["loginError"] = 'Account locked. Try again after 60 seconds.';
            header('Location: /login');
            die;
        }

        $statement = $db->prepare("SELECT * FROM users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $rows['password'])) {
            // Successful attempt
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $rows['id'];
            unset($_SESSION['loginError']);
            $attempt = 'good';
        } else {
            // Failed attempt
            $attempt = 'bad';
        }

        // Log the attempt to logs table in db
        $logModel->logAttempt($username, $attempt);

        if ($attempt === 'good') {
            header('Location: /home');
        } else {
            $result = $logModel->getFailedAttempts($username);
            if ($result['failed_attempts'] >= 3) {
                $_SESSION["loginError"] = 'Account locked. Try again after 60 seconds.';
            } else {
                $_SESSION["loginError"] = 'Invalid username or password.';
            }
            header('Location: /login');
        }
        die;
    }

    public function create($username, $password, $verifypassword) {
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/';
        // Check if fields are empty
        if (empty($username) || empty($password) || empty($verifypassword)) {
            $_SESSION["createError"] = 'All fields are required';
            header("Location: /create");
            die;
        }
        // Check if passwords match
        if ($password !== $verifypassword) {
            $_SESSION["createError"] = 'Passwords do not match';
            header("Location: /create");
            die;
        }
        // Validate password pattern
        if (!preg_match($passwordPattern, $password)) {
            $_SESSION["createError"] = 'Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.';
            header("Location: /create");
            die;
        }

        $db = db_connect();
        // Check if username exists
        $statement = $db->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
        $statement->execute([$username]);
        if ($statement->fetchColumn() > 0) {
            $_SESSION["createError"] = 'Username already exists';
            header("Location: /create");
            die;
        }

        // Hash the password and add user to db
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $statement = $db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        if ($statement->execute([$username, $hashed_password])) {
            // Set session variables
            $_SESSION["auth"] = 1;
            $_SESSION["username"] = $username;
            $userId = $db->lastInsertId();
            $_SESSION["user_id"] = $userId;

            // Log the successful login attempt
            $logModel = new Log();
            $logModel->logAttempt($username, 'good');
            header("Location: /home");
            die;

        } else {
            $statement->closeCursor();
            $_SESSION["createError"] = 'Registration failed, please try again';
            header("Location: /create");
            die;
        }
    }
}
?>