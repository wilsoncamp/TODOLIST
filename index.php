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
<body class="bg-light">

    <header class="bg-warning">
        <h1 class="container d-flex justify-content-center py-5 fw-bold">To Do Lists</h1>
    </header>

    <!-- Add Tasks -->
    <div class="d-flex justify-content-center mt-4">
        <a href="./create.php" type="button" class="btn btn-primary"><i class="bi bi-plus-square me-2"></i>
            Add Tasks
        </a>
    </div>

        <!-- PopUp tasks -->
        <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title text-uppercase fs-5" id="exampleModalLabel">Add tasks</h1>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    

                    <div class="modal-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">Work Lists</label>
                                <input type="text" class="form-control shadow-none" name="lists" value="<?php echo $lists; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">Time</label>
                                <input type="time" class="form-control shadow-none" name="time" value="<?php echo $time; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">Date</label>
                                <input type="date" class="form-control shadow-none" name="date" value="<?php echo $date; ?>">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" name="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        
    
    <!-- Table -->
    <table class="container table table-hover mt-5 rounded">
        <thead>
            <tr>
                <th scope="col">Serial No.</th>
                <th scope="col">Work Lists</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            
        <?php
            $servername = "localhost";
            $username = "root";
            $pass = "";
            $db = "todolists";

            $conn = new mysqli($servername, $username, $pass, $db);
            if($conn -> connect_error){
                die("Connection Failed ".$connect_error);
            }
            $sql = "SELECT * FROM todolist";
            $result = $conn -> query($sql);

            if(!$result) {
                die("Invalid query ".$conn -> error);
            }

            while($row = $result -> fetch_assoc()) {
                echo "
                        <tr>
                            <th>$row[sr_no]</th>
                            <td>$row[lists]</td>
                            <td>$row[time]</td>
                            <td>$row[date]</td>
                            <td>$row[created_at]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='edit.php?id=$row[sr_no]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=$row[sr_no]'>Delete</a>
                            </td>
                        </tr>
                    ";
            }

        ?>

        </tbody>
    </table>
    



<!-- Bootsrap js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>