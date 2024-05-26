<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deptName = trim($_POST["deptName"]);

    // Validating input data
    if (empty($deptName)) {
        session_start();
        $_SESSION["success"] = false;

        header("Location: ../createDepartment.php");
        die();
    }

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO department(deptName) VALUES(:deptName);";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":deptName", $deptName);
        $stmt->execute();
        
        // Setting the sucess message
        session_start();
        $_SESSION["success"] = true;

        $pdo = null;
        $stmt = null;
        header("Location: ../createDepartment.php");
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