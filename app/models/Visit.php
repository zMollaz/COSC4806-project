<?php
session_start();

class Visit {

    public function __construct() {

    }

    public function increment_counter() {
        $db = db_connect();
        $statement = $db->prepare("UPDATE visits SET count = count + 1 WHERE id = 1");
        $statement->execute();
    }

    public function get_visit_count() {
        $db = db_connect();
        $statement = $db->prepare("SELECT count FROM visits WHERE id = 1");
        $statement->execute();
        return $statement->fetchColumn();
    }
}
?>