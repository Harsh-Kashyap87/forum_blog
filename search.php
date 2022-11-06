<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Makeup Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<style>
    #main{
        min-height: 92vh;
    }
    #sec{
        min-height: 81vh;
    }
</style>
<body class="d-flex flex-column">
    <?php
    // include 'partial/count.php';
    include 'partial/_dpconnect.php';
    include 'partial/_header.php';
    // if()
?>

<!-- echo '<h1 class="text-center">Search results for "<em>' . $query . '</em>"</h1>'; -->
<div class="conatiner"  id="main">
<?php
    $noResult = true;
    $query = $_GET['search'];
    $sql = "SELECT * FROM thread WHERE MATCH (t_tittle, t_desc) against ('$query')";
    $result = mysqli_query($conn, $sql);
    echo '<h1 class="text-center">Search results for "<em>' . $query . '</em>"</h1>';
    
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['t_tittle'];
        $desc  = $row['t_desc'];
        $id = $row['t_id'];
        $noResult = false;
        
        echo '<div class="container my-4">
                <div class="container my-3">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="my-3">
                        <h5><a href="thread.php?threadid=' . $id . '" class="text-dark">' . $title . '</a></h5>
                        <p class="lead">' . $desc .'</p>
                        </div>
                    </div>
                </div>
            </div>';
    }
    if($noResult)
    {
        echo '<div class="container my-3"  id="sec">
        <h2>Browse Result</h2>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">No Result Found!</h1>
              <p class="lead">Be the first person to ask...</p>
            </div>
          </div>';
        
    }
?>
</div>
<?php
include 'partial/_footer.php';
?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
                crossorigin="anonymous">
            </script>
</body>

</html>