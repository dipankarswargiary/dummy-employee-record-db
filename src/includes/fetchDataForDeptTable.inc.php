<?php

/**
 * Description:
 * ------------
 * It fetches necessary infos for createDepartment.php page
 * i.e. department information for department table and
 * filtered department information for search operation
 */

try {
    require_once "includes/dbh.inc.php";

    if (!empty(trim($_GET["search"]))) {
        // fetching filtered data for searching
        $search = trim($_GET["search"]);

        $query = "SELECT d.deptName,
            COUNT(e.id) AS totalEmps
            FROM department d LEFT JOIN employees e
            ON d.id = e.deptID
            WHERE d.deptName LIKE :search
            GROUP BY d.deptName
            ORDER BY d.deptName ASC;";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":search", "$search%");
        $stmt->execute();
    }
    else {
        // fetching all department info
        $query = "SELECT d.deptName,
        COUNT(e.id) AS totalEmps
        FROM department d LEFT JOIN employees e
        ON d.id = e.deptID
        GROUP BY d.deptName
        ORDER BY d.deptName ASC;";
    
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    $deptData = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
catch(PDOException $e) {
    echo "Query failed: " . $e->getMessage();
    die();
}