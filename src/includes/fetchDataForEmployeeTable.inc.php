<?php

/**
 * Description:
 * -----------
 * It fetches data for employee table which is used in
 * index.php and updateDeleteEmployee.php pages.
 * 
 * Fetched data:
 * Department information for select element
 * Employee information for employee table and
 * Filtered employee information for search operation
 */

try {
    require "includes/dbh.inc.php";

    // fetching all department info
    $query = "SELECT * FROM department ORDER BY(deptName) ASC;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $deptInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if (!empty(trim($_GET["search"]))) {
        // fetching filtered employee data for searching
        $search = trim($_GET["search"]);

        // deptID is used only in updateDeleteEmployee.php page
        $query = "SELECT e.id, e.name, e.address,
            e.designation, d.id AS deptID, d.deptName
            FROM employees e
            JOIN department d
            ON e.deptID = d.id
            WHERE e.name LIKE :search
            ORDER BY e.name ASC;";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":search", "$search%");
        $stmt->execute();
    }
    else {
        // fetching all employee info
        $stmt = null;
        $query = "SELECT e.id, e.name, e.address,
            e.designation, d.id AS deptID, d.deptName
            FROM employees e
            JOIN department d
            ON e.deptID = d.id
            ORDER BY e.name ASC;";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }
    
    $employeeInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    die();
}