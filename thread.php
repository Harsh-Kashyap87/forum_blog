<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Makeup Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    // include 'partial/count.php';
    include 'partial/_dpconnect.php';
    include 'partial/_header.php';
?>

<?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `thread` WHERE t_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result))
        {
            $noResult = false;
            $title = $row['t_tittle'];
            $desc = $row['t_desc'];
            $t_user_id = $row['t_user_id'];

            $sql2 = "select email from `users` where sno=$t_user_id";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['email'];
        }
    ?>

    <!-- Php for inserting answer into DB -->
    <?php
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'POST')
            {
                $comment = $_POST['comment'];
                $sno = $_POST['sno'];

                $comment = str_replace("<", "&lt", $comment);
              $comment = str_replace(">", "&gt", $comment);

                // echo $t_title;
                // echo $t_desc;
                $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successfully</strong> Your answer has been submitted..
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
                else
                {
                    echo "Not inserted";
                }
            }
        ?>


  
    <!-- Script for showing details -->
    <?php
 echo '
 <div class="container my-4">
 <div class="jumbotron">
     <h1 class="display-4">' . $title . '</h1>
     <p class="lead"> ' . $desc . ' 
     </p>
     <hr class="my-4">
     <p>.No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not
         post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members
         at all times. </p>
         <p class="text-left"><em>Posted by : '. $posted_by . ' </em></p>
 </div>
</div>
 ';
// echo var_dump($noResult);
if($noResult)
{
 echo '<div class="jumbotron jumbotron-fluid">
 <div class="container">
   <h1 class="display-4">No Quetions Found!</h1>
   <p class="lead">Be the first person to ask...</p>
 </div>
</div>';
}
?>

    <!-- Post a answer for thread -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<div class="container">

        <form action=' . $_SERVER["REQUEST_URI"] . ' method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Write your asnwer</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value=" ' . $_SESSION["sno"] . '">
            </div>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
';
    }
    else{
        echo '
        <div class="container">
        <h1 class="py-2">Post a Comment</h1> 
           <p class="lead">You are not logged in. Please login to post comments.</p>
        </div>
        ';
    }

?>




    <!-- Discussion about my answers -->
    <div class="container my-3">
        <h2>Discussion</h2>
        <!-- Questions Section -->
        <!-- Comments  -->
        <?php
            $id = $_GET['threadid'];
            // echo $id;
            $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
            $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result))
        {
            $content = $row['comment_content'];
            $time = $row['comment_time'];
            $user = $row['comment_by'];
            // echo $content;
            $noResult = false;
            $sql2 = "select email from `users` where sno=$user";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            // echo $row2['email'];
            $email = $row2['email'];
            echo '
        <div class="d-flex my-4">
            <div class="flex-shrink-0">
                <img src="partial/img/user.jpg" width="55px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3 my-3"><p>Posted by : <strong> ' . $email . '</strong> ' . $time . '</p>'. $content . ' 
            </div>
        </div>
            ';
        }
        if($noResult)
        {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">No Answer Found!</h1>
              <p class="lead">Be the first person to answer...</p>
            </div>
          </div>';
        }
        ?>

    </div>
    <?php
              include 'partial/_footer.php';
        ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</body>

</html>