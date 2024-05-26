<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["empID"];
    $name = trim($_POST["name"]);
    $address = trim($_POST["address"]);
    $designation = trim($_POST["designation"]);
    $deptID = $_POST["department"];

    try {
        require_once "dbh.inc.php";

        session_start();
        if (!empty($id)) {

            // Updating each attribute separately to handle empty fields
            if (!empty($name)) {
                $query = "UPDATE employees
                    SET name = :name
                    WHERE id = :empID;";
                
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":empID", $id);
                $stmt->execute();
            }

            if (!empty($address)) {
                $query = "UPDATE employees
                    SET address = :address
                    WHERE id = :empID;";
                
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":address", $address);
                $stmt->bindParam(":empID", $id);
                $stmt->execute();
            }

            if (!empty($designation)) {
                $query = "UPDATE employees
                    SET designation = :designation
                    WHERE id = :empID;";
                
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":designation", $designation);
                $stmt->bindParam(":empID", $id);
                $stmt->execute();
            }

            if (!empty($deptID)) {
                $query = "UPDATE employees
                    SET deptID = :deptID
                    WHERE id = :empID;";
                
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":deptID", $deptID);
                $stmt->bindParam(":empID", $id);
                $stmt->execute();
            }

            $pdo = null;
            $stmt = null;

            // Setting the success message
            $_SESSION["updated"] = true;
            header("Location: ../updateDeleteEmployee.php");
            die();
        }
        else {
            $_SESSION["updated"] = false;
            header("Location: ../updateDeleteEmployee.php");
            die();
        }
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