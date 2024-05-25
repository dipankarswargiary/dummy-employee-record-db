<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $address = trim($_POST["address"]);
    $designation = trim($_POST["designation"]);
    $deptID = $_POST["department"];

    // Validating input data
    if (empty($name) || empty($address) || empty($designation) || empty($deptID)) {
        session_start();
        $_SESSION["sucess"] = false;
        
        header("Location: ../index.php");
        die();
    }

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO employees(name, address, designation, deptID)
            VALUES(:name, :address, :designation, :deptID);";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":designation", $designation);
        $stmt->bindParam(":deptID", $deptID);
        
        $stmt->execute();
        
        // Seting the sucessfull message
        session_start();
        $_SESSION["sucess"] = true;

        $pdo = null;
        $stmt = null;
        header("Location: ../index.php");
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