<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["empID"];
    
    try {
        require_once "dbh.inc.php";

        $query = "DELETE FROM employees WHERE id = :id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $pdo = null;
        $stmt = null;
        header("Location: ../updateDeleteEmployee.php");
        die();
    }
    catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
        die();
    }
}
else {
    header("Location: ../index.php");
    die();
}