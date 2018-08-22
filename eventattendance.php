<!DOCTYPE html>
<html>
    <head>
        <title>Event Attendace</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./Public/CSS/style.css">
        <style>
        
       .flex
       {
           display: flex;
           flex-direction: column-reverse;
       }
       table
       {
           text-align: center;
       }
        </style>
    </head>

    <body>
        <?php include './Public/Template/header.php';
        if(!isset($_SESSION))
        {
            session_start();
        }
        if(isset($_POST['submit']))
        {        
            $conn = new mysqli("sql309.byethost.com", "b12_22578967", "knrhq3uuGJnw", "b12_22578967_attendance") or die('Error connecting to MySQL server.');
            $query = "SELECT * FROM logindetails WHERE '" . $_POST["loginName"] . "'= loginName ";
            $query1 = "SELECT * FROM users WHERE '" . $_POST["loginName"] . "'= email ";
            mysqli_query($conn, $query) or die('Error querying database.');
            mysqli_query($conn, $query1) or die('Error querying database.');
            $result1=mysqli_query($conn,$query);
            $result2=mysqli_query($conn,$query1);

            if(mysqli_num_rows($result1) > 0){
                
                $conn = new mysqli("sql309.byethost.com", "b12_22578967", "knrhq3uuGJnw", "b12_22578967_attendance") or die('Error connecting to MySQL server.');
            
                $tempQuery2 = "UPDATE logindetails SET  loginDatetime = CURRENT_TIMESTAMP WHERE '" . $_POST["loginName"] . "'= loginName ";

                $last_id = 1;

                if ($conn->query($tempQuery2) === TRUE) {
                    $last_id = $conn->insert_id;

                    //echo "New record created successfully. Last inserted ID is: " . $last_id;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;

                }
            
                ?>
                <div class="container flex">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Event</th>
                            <th>Attendance</th>
                        </tr>
                
        
                <?php
                    $query1 = "SELECT * FROM users WHERE '" . $_POST["loginName"] . "'= email ";
                    $result1=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_array($result1)):?>
                        <tr>
                            <td><?php echo $row['loginID'];?></td>
                            <td><?php echo $row['loginName'];?></td>
                            <td><?php echo $row['deptID'];?></td>
                            <td><?php echo $row['eventID'];?></td>
                            <td><?php echo $row['loginDateTime'];?></td>
                        </tr>

               
                    <?php 
                        endwhile;

                    }

                    else
                    {
                        $query2 = "INSERT INTO logindetails(loginName) VALUES ('" . $_POST["loginName"] . "')";
                        $last_id = 1;
                        function emailAddNotify($email)
                        {
                            echo 
                                "<script language='javascript'>
                                alert('New user email address : $email');
                                </script>";
                        }
                        if ($conn->query($query2) === TRUE) {
                                $last_id = $conn->insert_id;

                                emailAddNotify($_POST["loginName"]);
                                
                                //echo "New record created successfully. Last inserted ID is: " . $last_id;
                        } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;

                                }

                    }
        
                mysqli_close($conn);
        }
        ?>

                </table>

            

            <?php $conn = new mysqli("sql309.byethost.com", "b12_22578967", "knrhq3uuGJnw", "b12_22578967_attendance") or die('Error connecting to MySQL server.');
            $query = "SELECT * FROM departments";
            mysqli_query($conn, $query) or die('Error querying database.');
            $result=mysqli_query($conn,$query);
            ?>
    
                <div class="container">
                <div class = "row">
                    <div class = "col-md-12">
                        <form action="eventattendance.php" method="POST">
                            <label for="loginName">
                            Email
                            </label>
                            <input type="email" id="email" name="loginName">

                            <label for="department">
                            Department
                            </label>

                            <select id="department" name="deptName">
                            <?php
                            while($row=mysqli_fetch_array($result)):?>
                            <option value="<?php echo $row['deptID'];?>"><?php echo $row['deptName'];?></option>
                            <?php endwhile; ?>

                            </select>
                            <?php 
                                
                                mysqli_close($conn);
                            ?>

                            <input type="submit" name="submit" value="SUBMIT">
                        </form>

                    </div> <!-- END OF COL-MD-12 -->
                </div> <!-- END OF Row -->
                </div>
            </div>
            

            <?php include './Public/Template/footer.php';?>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>