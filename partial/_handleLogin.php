<?php
    
    $showErr = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // $login = false;
        include '_dpconnect.php';
        // echo "Logged In";
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        // echo $email;
        // echo $pass;
        $sql = "select * from users where email='$email' ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
            if($num == 1 )
            {// echo "FEtched";
                $row = mysqli_fetch_assoc($result);
                    if(password_verify($pass, $row['password']))
                    {
                        // $login = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['email'] = $email;
                        $_SESSION['sno'] = $row['sno'];
                        // $_SESSION['sno'] = $row['sno'];
                        echo "loggedin " . $email;
                        header('location: /forum/index.php?login=success');
                        exit();
                    }
                    else
                {
                    header('location: /forum/index.php?login=not');
                }
                    // header('location: /forum/index.php?login=');

                }
                else
                {
                    header('location: /forum/index.php?login=not');
                }
    }
?>