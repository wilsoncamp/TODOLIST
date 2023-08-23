<?php

$servername = "localhost";
$username = "root";
$pass = "";
$db = "todolists";

$conn = new mysqli($servername, $username, $pass, $db);

    $sr_no = "";
    $lists = "";
    $time = "";
    $date = "";

    $errorMessage = "";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(!isset($_GET["id"])){
            header("location: ./index.php");
            exit;
        }

        $sr_no = $_GET["id"];

        $sql = "SELECT * FROM todolist WHERE sr_no = $sr_no";
        $result = $conn -> query($sql);
        $row = $result -> fetch_assoc();

        if(!$row){
            header("location: ./index.php");
            exit;
        }

        $lists = $row["lists"];
        $time = $row["time"];
        $date = $row["date"];
    }
    else {
        $sr_no = $_POST["id"];
        $lists = $_POST["lists"];
        $time = $_POST["time"];
        $date = $_POST["date"];

        do{
            if(empty($sr_no) || empty($lists) || empty($time) || empty($date)) {
                $errorMessage = "All the fields are required";
                break;
            }

            $sql = "UPDATE todo SET lists = '$lists', time = '$time', date = '$date' WHERE sr_no = '$sr_no' ";
            $result = $conn -> query ($sql);

            if(!$result){
                $errorMessage = "Invalid query ".$conn -> error;
                break;
            }

            // $lists = "";
            // $time = "";
            // $date = "";

            $successMessage = "Client added succesfully";

            header("location: ./index.php");
            exit;

        } 
        while (true);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do Lists</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="bg-warning">
        <h1 class="container d-flex justify-content-center py-5 fw-bold">To Do Lists</h1>
    </header>

<div class="container bg-light rounded mt-5">
    <div class="text-center pt-4">
        <h2 class="text-uppercase fw-bold">Add tasks</h2>
    </div>

    <!-- error message -->
    <?php
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong> 
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
    ?>

    <!-- success message -->
        <?php
            if(!empty($successMessage)){
                echo "
                <div class='alert alert-sucess alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong> 
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }

        ?>

    <form method="POST" class="px-3 py-5">
        <input type="hidden" name="id" value="<?php echo $sr_no; ?>">
            <div class="form-group mb-3">
                <label class="form-label fw-bold text-secondary">Work Lists</label>
                <input type="text" class="form-control shadow-none" name="lists" value="<?php echo $lists; ?>">
            </div>
            <div class="form-group mb-3">
                <label class="form-label fw-bold text-secondary">Time</label>
                <input type="time" class="form-control shadow-none" name="time" value="<?php echo $time; ?>">
            </div>
            <div class="form-group mb-3">
                <label class="form-label fw-bold text-secondary">Data</label>
                <input type="date" class="form-control shadow-none" name="date" value="<?php echo $date; ?>">
            </div>

            <div class="d-flex flex-row mb-3">
                <div>
                    <button type="submit" class="btn btn-primary mt-3 me-2">Submit</button>
                </div>
                <div>
                    <a class="btn btn-outline-dark mt-3" href="./index.php">Cancel</a>
                </div>
            </div>
    </form>
</div>

<!-- Bootsrap js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>