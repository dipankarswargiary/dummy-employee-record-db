<?php

    // fetching necessary data from database
    include_once "includes/fetchDataForEmployeeTable.inc.php";
    require_once "config.php";

    /**
     * Reference:
     * ---------
     * $deptInfo : fetches dept infos for select element
     * $employeeInfo : fetches employee infos for the table
     *                (including filtered data for search operation)
     */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register employees</title>

    <!-- link to CSS and Bootstrap CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    
    <link type="text/css" rel="stylesheet" href="style.css" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Questrial&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Displaying sucess/error message -->
    <?php
        session_start();

        if (isset($_SESSION["sucess"]) && $_SESSION["sucess"]) {
            ?>

            <script>
                window.onload = function() {
                    alert("Data inserted sucessfully!");
                }
            </script>

            <?php
            unset($_SESSION["sucess"]);
        }
        else if (isset($_SESSION["sucess"]) && !$_SESSION["sucess"]) {
            ?>
            
            <script>
                window.onload = function() {
                    alert("Error: Please insert all the fields!");
                }
            </script>

            <?php
            unset($_SESSION["sucess"]);
        }
    ?>

</head>
<body>

    <!-- Nav bar -->

    <article class="container-fluid navbar-container">
            <nav class="navbar border-bottom border-body" data-bs-theme="light">

                <div class="container">
                    <a class="navbar-brand">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 20 20">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                        Employees
                    </a>

                    <form class="d-flex" role="search" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search Name" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

            </div>
        </nav>
    </article>


    <!-- Insert form -->
    
    <article class="container index-form">
        <div class="row">
            <div class="col-sm-4">
                <form action="includes/registerEmployee.inc.php" class="index-form-area" method="post">

                    <h1>Register <br/>Employees</h1>

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
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    
                    <div class="a-container">
                        <a href="createDepartment.php">Show departments</a>
                    </div>

                </form>

                <!-- Go to update page button -->
                <a href="updateDeleteEmployee.php" class="index-update-btn">
                    <div class="d-grid gap-2">
                        <button class="btn btn-secondary" type="button">
                            Update or delete employees

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 1 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                            </svg>
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
                                    <th scop="col" class="sl">#</th>
                                    <th scor="col">Employee name</th>
                                    <th scor="col">Address</th>
                                    <th scop="col">Designation</th>
                                    <th scop="col">Department</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $rowNumber = 1;
                                foreach ($employeeInfo as $emp) {
                                    ?>

                                    <tr>
                                        <th scop="row"> <?php echo $rowNumber; ?> </th>
                                        <td> <?php echo htmlspecialchars($emp["name"]); ?> </td>
                                        <td> <?php echo htmlspecialchars($emp["address"]); ?> </td>
                                        <td> <?php echo htmlspecialchars($emp["designation"]); ?> </td>
                                        <td> <?php echo htmlspecialchars($emp["deptName"]); ?> </td>
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

