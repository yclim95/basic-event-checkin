<!DOCTYPE html>
<html>
    <head>
        <title>Create Event</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="./Public/CSS/style.css">
        <style>
        body{
            font-size: 24px;
        }
        </style>
    </head>

    <body>
        <?php include './Public/Template/header.php';?>
        <?php 
        
            if(!isset($_SESSION))
            {
                session_start();
            }
            if(isset($_POST['submit']))
            {

            
                $conn = new mysqli("sql309.byethost.com", "b12_22578967", "knrhq3uuGJnw", "b12_22578967_attendance") or die('Error connecting to MySQL server.');
                $query = "INSERT INTO EVENTS(eventName,eventDateTime)
                VALUES('" . $_POST["eventName"] . "', '" . $_POST["eventDateTime"] . "')";

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

        <form action="createevent.php" method="POST">
            <label for="eventName">
            Event Name:
            </label>
            <input type="text" id="eventName" name="eventName" required>

            <label for="eventDateTime">
            Date Time:
            </label>
            <input type="datetime-local" id="eventDateTime" name="eventDateTime" required>

            <input type="submit" name="submit" value="SUBMIT">
        </form>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>