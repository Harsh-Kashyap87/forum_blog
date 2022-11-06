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
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `category` WHERE c_id=$id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $catname = $row['c_name'];
            $catdesc = $row['c_discription'];
        
        }
    ?>




    <?php
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'POST')
            {
                $t_title = $_POST['tittle'];
                $t_desc = $_POST['desc'];
                $sno = $_POST['sno'];

                
            $t_title = str_replace("<", "&lt", $t_title);
            $t_title = str_replace(">", "&gt", $t_title);

            $t_desc = str_replace("<", "&lt", $t_desc);
            $t_desc = str_replace(">", "&gt", $t_desc);


                // echo $t_title;
                // echo $t_desc;
                $sql = "INSERT INTO `thread` (`t_tittle`, `t_desc`, `t_cat_id`, `t_user_id`, `timeStamp`) VALUES ('$t_title', '$t_desc', '$id', '$sno', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successfully</strong> Your concern has been submitted.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
                else
                {
                    echo "Not inserted";
                }
            }
        ?>
        
    <?php
    
        echo '
        <div class="container text-center my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to the ' . $catname . ' forum</h1>
            <p class="lead"> ' . $catdesc . ' 
            </p>
            <hr class="my-4">
            <p>.No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not
                post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members
                at all times. </p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
        ';
    
    
?>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<div class="container">
        <h2>Ask a Question</h2>
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="form-group">
                <label for="exampleFormControlInput1">Write down your concern</label>
                <input type="text" class="form-control" id="tittle" name="tittle"
                    placeholder="Write your quetion title here.">
            </div>
            <input type="hidden" name="sno" value=" ' . $_SESSION["sno"] . '">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Elaborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
        </div>';
    }
    else{
        echo '
        <div class="container">
        <h1 class="py-2">Ask Question</h1> 
           <p class="lead">You are not logged in. Please login to post comments.</p>
        </div>
        ';
    }

?>

    

    <!--  Cards - categories -->

    <div class="container my-3">
        <h2>Browse Quetions</h2>
        <!-- Questions Section -->
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `thread` WHERE t_cat_id=$id;";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result))
        {
            $noResult = false;
            $id = $row['t_id'];
            $tittle = $row['t_tittle'];
            $desc = $row['t_desc'];



            $time = $row['timeStamp'];
            $user = $row['t_user_id'];
            $sql2 = "select email from `users` where sno=$user;";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $email = $row2['email'];
            echo '
        <div class="d-flex">
            <div class="flex-shrink-0">
                <img src="partial/img/user.jpg" width="55px" alt="..."> 
            </div><p class="ml-10">
            <div class="flex-grow-1 ms-3 my-3">
                <h6><p>Asked by : <strong>' . $email . '</strong> at ' . $time . '</p><h3><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $tittle . '</a></h3></h6>' . $desc . '
            </div>
        </div>
            ';
        }
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



        <!-- <div class="d-flex">
            <div class="flex-shrink-0">
                <img src="partial/img/user.jpg" width="55px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3 my-3">
                <h6>How to use a bridal makeup kit as professionals.</h6>
                This is some content from a media component. You can replace this with any content and adjust it as
                needed.
            </div>
        </div> -->

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