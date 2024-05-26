<?php

    // fetching necessary data from database
    require_once "includes/fetchDataForEmployeeTable.inc.php";

    /**
     * Reference:
     * ---------
     * $deptInfo : fetches department info for select element
     * $employeeInfo : fetches employee infos for the table
     *                  (including filtered data for search operation)
     */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update or delete info</title>

    <!-- link to CSS and Bootstrap CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    
    <link type="text/css" rel="stylesheet" href="style.css" />
    <script defer src="scripts/updateDeleteEmployeeScript.js"></script>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Questrial&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Javascript: confirmation prompt for deleting data --> 
    <script>

        function deleteEmp(elem) {
            let sl = elem.parentElement.firstElementChild;
            if (!window.confirm("Are you sure you want to delete \""
                + sl.nextElementSibling.innerHTML + "\"")) {
                event.preventDefault();
            }
        }

    </script>

    <!-- Displaying sucess/failure message -->
    <?php
        session_start();

        if (isset($_SESSION["updated"]) && $_SESSION["updated"]) {
            ?>

            <script>
                window.onload = function() {
                    alert("Data updated sucessfully!");
                }
            </script>

            <?php
            unset($_SESSION["updated"]);
        }
        else if (isset($_SESSION["updated"]) && !$_SESSION["updated"]) {
            ?>

            <script>
                window.onload = function() {
                    alert("Please select a row to update!");
                }
            </script>

            <?php
            unset($_SESSION["updated"]);
        }
    ?>

</head>
<body>

    <!-- Nav bar -->

    <article class="container-fluid navbar-container">
        <nav class="navbar border-bottom border-body" data-bs-theme="light">
            <div class="container">

                <a class="navbar-brand">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 20 20">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                    </svg>
                    Update and delete employees
                </a>

                <form class="d-flex" role="search" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search Name" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

            </div>
        </nav>
    </article>


    <!-- Insert form -->
    
    <article class="container index-form">
        <div class="row">
            <div class="col-sm-4">
                <form action="includes/updateEmployeeInfo.inc.php" class="index-form-area" method="post">

                    <h1>Update <br />Employee Data</h1>
                    
                    <!-- This hidden input's value is used in updating employee info -->
                    <input type="hidden" value="" id="empID" name="empID" />

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Enter your name" />
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" name="address" id="address" placeholder="Enter your address" />
                    </div>
                    
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input class="form-control" type="text" name="designation" id="designation" placeholder="Enter your designation" />
                    </div>

                    <div class="form-group">
                        <label for="department">Department</label>
                        <select class="form-select" name="department" id="department">
                            <option value="" class="empty-option">Please select</option>
                            <?php
                                foreach ($deptInfo as $dept) {
                                    ?>
                                    <option value="<?php echo htmlspecialchars($dept["id"]); ?>">
                                        <?php echo htmlspecialchars($dept["deptName"]); ?>
                                    </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class="button-container">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    
                    <div class="a-container">
                        <a href="createDepartment.php">Show departments</a>
                    </div>

                </form>

                <!-- Go back button -->
                <a href="index.php" class="index-update-btn">
                    <div class="d-grid gap-2">
                        <button class="btn btn-secondary" type="button" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 2 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                            </svg>
                            Go back
                        </button>
                    </div>
                </a>
                
            </div>

            
            <!-- Employee table -->

            <div class="col-sm-8">

                <?php
                    if (!empty($employeeInfo)) {
                        ?>

                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scop="col" class="sl-no-col">#</th>
                                    <th scor="col">Employee name</th>
                                    <th scor="col">Address</th>
                                    <th scop="col">Designation</th>
                                    <th scop="col">Department</th>
                                    <th scop="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">

                            <?php
                                $rowNumber = 1;
                                foreach ($employeeInfo as $emp) {
                                    ?>

                                    <tr onclick="selectRow(this)">
                                        <th scop="row">
                                            <input type="hidden" value="<?php echo htmlspecialchars($emp["id"]); ?>" />
                                            <?php echo $rowNumber; ?>
                                        </th>

                                        <td> <?php echo htmlspecialchars($emp["name"]); ?> </td>
                                        <td> <?php echo htmlspecialchars($emp["address"]); ?> </td>
                                        <td> <?php echo htmlspecialchars($emp["designation"]); ?> </td>
                                        
                                        <td>
                                            <input type="hidden" value="<?php echo htmlspecialchars($emp["deptID"]); ?>">
                                            <?php echo htmlspecialchars($emp["deptName"]); ?>
                                        </td>

                                        <td class="unselectable" onclick="deleteEmp(this);">
                                            <form action="includes/deleteEmp.inc.php" method="post">
                                                <input type="hidden" name="empID" value="<?php echo htmlspecialchars($emp["id"]); ?>" />
                                                <button type="submit" class="delete-emp-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 20">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <?php
                                    $rowNumber++;
                                }
                            ?>

                            </tbody>
                        </table>

                        <?php
                    }
                    else {
                        ?>

                        <!-- Allert message in case of empty dataset -->
                        <div class="alert-message">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 20 20">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                            </svg>
                            No data available!
                        </div>

                        <?php
                    }
                ?>

            </div>
        </div>
    </article>

</body>
</html>

