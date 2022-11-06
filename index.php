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
    // if()
?>

    <!-- Carousel - categories -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="partial/img/img3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="partial/img/img2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="partial/img/img.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--  Cards - categories -->
    <div class="container text-center my-4">
        <h2>
            Makeup Blog - Categories
        </h2>
        <div class="row my-3">
            <?php
        
        ?>
            <!-- Use a for loop to itetare all categories -->

    <?php
          $sql = "SELECT * FROM `category` ";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result))
          {
            $id = $row['c_id'];
            $name = $row['c_name'];
            $decription = $row['c_discription'];
            
            // echo $name;
            // echo "<br>";
            // echo $decription;
            // echo "<br>";
            echo '<div class="col-md-4 my-2">
            <div class="card" style="width: 18rem;">
                <img src="partial/img/card-' . $id . '.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><a class="text-dark" href="threadlist.php?catid=' . $id . '">' . $name . '</a></h5>
                    <p class="card-text">' . substr($decription, 0, 60) . '.....</p>
                    <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">Show Thread</a>
                </div>
            </div>
        </div>';
        // echo $num++;

        
          }
        ?>

<?php
include 'partial/_footer.php';
?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
                crossorigin="anonymous">
            </script>
</body>

</html>