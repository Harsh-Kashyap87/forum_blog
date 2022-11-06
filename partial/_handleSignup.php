<?php
// $login = false;
$showErr = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // echo "POST";
        include '_dpconnect.php';
        
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        // echo $email;
        // echo $pass;
        // echo $cpass;
        // Checking that email is already exist or not
        $sqlExist = "SELECT * FROM users WHERE email = '$email' "; //this must be more accurate
        $result = mysqli_query($conn, $sqlExist);
        $numRow = mysqli_num_rows($result);
        if($numRow >0)
        {
            echo "email is already taken.";
            // $login = false;
            $showErr = "email already taken.";
            // header ("location: /forum/index.php?signupsuccess=email already taken.");
            
        }
        else{
            // echo "AVAIlable";
            if($pass == $cpass)
            {
                // Creating hash of the password for storing into Database
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                // echo $hash;
                $sql = "INSERT INTO `users` (`email`, `password`, `dt`) VALUES ('$email', '$hash', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    $showErr = true;
                    header ("location: /forum/index.php?signupsuccess=true");
                    exit();
                    // echo "You accout has been created";
                }
            }
            else
            {
                // echo "Your both password does not match";
                // $login = false;
                $showErr = "Your both password does not match";
                // header ("location: /forum/index.php?signupsuccess=Worng Password");

            }
        }
        header ("location: /forum/index.php?signupsuccess=false&error=$showErr");


    }
?>