<!DOCTYPE html>
<html>
    <head>
        <title>Event</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./Public/CSS/style.css">
        <style>
        table
        {
            border-collapse: collapse;
        }
        tr,td, th
        {
            border: 3px solid #000000;
        }
        </style>
    </head>

    <body>
        <?php include './Public/Template/header.php';?>

        <div class = "container">
            <div class="row">
        
                <?php
                $conn = new mysqli("sql309.byethost.com", "b12_22578967", "knrhq3uuGJnw", "b12_22578967_attendance") or die('Error connecting to MySQL server.');
                $query = "SELECT * FROM EVENTS";
                mysqli_query($conn, $query) or die('Error querying database.');
                $result=mysqli_query($conn,$query);
        

                if($result){
                ?>    
                <table>
                    <tr>
                    <th>No</th>
                    <th>Event Name</th>
                    <th>Event DATE TIME</th>
                    <th>Email</th>
                    <th>Options</th>
                    </tr>

                <?php
                    while($row=mysqli_fetch_array($result)):?>
                    <tr>
                        <td><?php echo $row['eventID'];?></td>
                        <td><?php echo $row['eventName'];?></td>
                        <td><?php echo $row['eventDateTime'];?></td>
                        <form action="event.php" method="POST">
                            <td><input type="email" name="email" ></td>
                            <td><input type="submit" name="submit" value="EMAIL INVITATION"></td>
                        </form>
                    </tr>
                

                <?php 
                    endwhile;
                    }
        

                
                    if(isset($_POST['submit']))
                    {
                        echo $_POST["email"];
                        $to = $_POST["email"];
                        $subject = "INVITATION TO .....";
                        $txt = "Hello !";
                        $from = "lyc950421@gmail.com";
                        $headers = "From: $from";

                        mail($to,$subject,$txt,$headers);
                    }
                    else
                    {
                        
                    }

                    mysqli_close($conn);
                    
                    ?>
                </table>
            </div>
        </div>
        

        <?php include './Public/Template/footer.php';?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
    </body>
</html>