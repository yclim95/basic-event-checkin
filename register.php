<!DOCTYPE html>
<html class="h-100">
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./Public/CSS/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Register</title>
    </head>

    <body class="pt-3 h-100">
    <?php include './Public/Template/header.php';
     if(!isset($_SESSION))
     {
         session_start();
     }
     if(isset($_POST['submit']))
     {
        $conn = new mysqli("sql309.byethost.com", "b12_22578967", "knrhq3uuGJnw", "b12_22578967_attendance") or die('Error connecting to MySQL server.');
        $query = "INSERT INTO users(userName,email,password,contactNo,deptID)
                    VALUES('" . $_POST["userName"] . "', '" . $_POST["email"] . "', '" . $_POST["password"] . "', '" . $_POST["contactNo"] . "',
                    '" . $_POST["deptID"] . "')";
        $last_id = 1;
        if ($conn->query($query) === TRUE) {
                    $last_id = $conn->insert_id;

                    echo "SUCCESS: ";
                    
                    //echo "New record created successfully. Last inserted ID is: " . $last_id;
            } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;

                    }
        $conn->close();//close connection
        }

    ?>

    <?php $conn = new mysqli("sql309.byethost.com", "b12_22578967", "knrhq3uuGJnw", "b12_22578967_attendance") or die('Error connecting to MySQL server.');
            $query = "SELECT * FROM departments";
            mysqli_query($conn, $query) or die('Error querying database.');
            $result=mysqli_query($conn,$query);
            ?>

    <main role="main" class="container d-flex flex-column h-100">
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="Name">
                    Name:
                    </label>
                    <input type="text" id="Name" name="userName" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">
                    Email:
                    </label>
                    <input type="email" id="email" name="email" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">
                    Password:
                    </label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="Contact">
                    Contact:
                    </label>
                    <input type="text" id="contact" name="contactNo" required class="form-control">

                </div>

                <div class="form-group">
                    <label for="deptID">
                    Department ID:
                    </label>
                    <select id="department" name="deptID" class="form-control">
                    <?php
                    while($row=mysqli_fetch_array($result)):?>
                        <option value="<?php echo $row['deptID'];?>"><?php echo $row['deptName'];?></option>
                    <?php endwhile; ?>

                    </select>
                    <?php 
                            
                            mysqli_close($conn);
                    ?>

                </div>

                   
                <div class="form-group row">   
                    <div class="col-sm-10">
                    <button type="submit" name="submit" value="SUBMIT" class="btn btn-primary">SUBMIT</button>
                    </div>
                </div>

                   
                   
                    
            </form>
            
        </main>

        <?php include './Public/Template/footer.php';?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>