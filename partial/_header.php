<?php

// $login = false;
$showErr = false;
// $login = "h";
session_start();
echo '
<nav class="navbar navbar-expand-lg bg-danger text-white navbar-dark">
<div class="container-fluid">
  <a class="navbar-brand " href="http://localhost/forum/">Make-up Blog</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="http://localhost/forum/contact.php">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="http://localhost/forum/about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Categories
        </a>
        <ul class="dropdown-menu">
          <li>';
          $sql = "SELECT c_name, c_id FROM `category` limit 5";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            
            echo '<a class="dropdown-item" href="threadlist.php?catid='. $row['c_id'] . '">' . $row['c_name'] . '</a></li>';
          }
          
        echo '</ul>
      </li>
      
    </ul>
    ';
    

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
      echo '<form class="d-flex" action="search.php" method="get" role="search">
      <input class="form-control me-2" name="search" type="search" action="search.php" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-dark" type="submit">Search</button>
      <a href="partial/_logout.php" type="button" class="btn btn-dark mx-2">Logout</a>
      <p class="text-dark my-0 mt-2"></form>';
      echo 'Welcome ' . $_SESSION['email']  . ' ';
    }

    else
    {

      // echo"not loggedin";thread.php?threadid=
      echo '<form class="d-flex" role="search" action="search.php" method="get" >
      <input class="form-control me-2" name="search" type="search" action="search.php" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-dark" type="submit">Search</button>
      <form class="d-flex"><button type="button" class="btn btn-dark mx-2" data-bs-toggle="modal" data-bs-target="#loginModal ">Login</button>


      <button type="button" class="btn btn-dark ml-0" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
    }

       

    echo'</form>
  </div>
</div>
</nav>
';

include 'partial/_login.php';
include 'partial/_signup.php';
// $get = $_GET['err'];
// $g = $_GET['signupsuccess'];

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true")
{
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success! </strong>Your account has been created.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
// echo $_GET['signupsuccess'];
}
else if(isset($_GET['signupsuccess']) == "false")
{
  $err = $_GET['error'];
  echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Invalid! </strong>' . $err . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
// echo $_GET['signupsuccess'];
}


// creating alrets for login/ login- failed/logout
// $status = $_GET['login'];

// if($status == "not")
// {
//   echo "Not login";
// }
// else if($status == "logout")
// {
//   echo "logged out";
// }
// else if($status == 'success')
// {
//   echo "login";
// }
?>