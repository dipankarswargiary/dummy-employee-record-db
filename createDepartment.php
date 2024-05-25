<?php

    // fetching necessary data from database
    require_once "includes/fetchDataForDeptTable.inc.php";
    
    /**
     * Reference:
     * $deptData : all fetched department data are stored here
     */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Department</title>

    <!-- link to CSS and Bootstrap CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">

    <link type="text/css" rel="stylesheet" href="style.css" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Questrial&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Displaying sucess/failure message -->
    <?php
        session_start();

        if (isset($_SESSION["success"]) && $_SESSION["success"]) {
            ?>

            <script>
                window.onload = function() {
                    alert("Data inserted sucessfully!");
                }
            </script>

            <?php
            unset($_SESSION["success"]);
        }
        else if (isset($_SESSION["success"]) && !$_SESSION["success"]) {
            ?>

            <script>
                window.onload = function() {
                    alert("Error: Please enter valid data!");
                }
            </script>

            <?php
            unset($_SESSION["success"]);
        }
    ?>

</head>
<body>

    <!-- Nav bar -->

    <article class="container-fluid navbar-container">
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                
                <a class="navbar-brand">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 20 20">
                        <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                    </svg>
                    Departments
                </a>

                <form class="d-flex" role="search" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

            </div>
        </nav>
    </article>


    <!-- Insert form -->

    <article class="container index-form">
        <div class="row">
            <div class="col-sm-4">
                <form action="includes/createDepartment.inc.php" class="index-form-area" method="post">

                    <h1>Create New <br/>Department</h1>
                    <br />

                    <div class="form-group">
                        <label for="deptName">Department Name</label>
                        <input class="form-control" type="text" name="deptName" id="deptName" placeholder="Enter department name" />
                    </div>

                    <div class="button-container">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>

                    <div class="a-container">
                        <a href="index.php">Show employees</a>
                    </div>
                </form>
            </div>


            <!-- Departments table -->

            <div class="col-sm-8">

                <?php
                    if (!empty($deptData)) {
                        ?>

                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scop="col" class="sl">#</th>
                                    <th scor="col">Department</th>
                                    <th scop="col" class="emp-count">Number of employees</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                $rowNumber = 1;
                                foreach ($deptData as $dept) {
                                    ?>

                                    <tr>
                                        <th scop="row"> <?php echo $rowNumber; ?> </th>
                                        <td> <?php echo htmlspecialchars($dept["deptName"]); ?> </td>
                                        <td> <?php echo htmlspecialchars($dept["totalEmps"]); ?> </td>
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