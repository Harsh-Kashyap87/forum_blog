<?php
session_start();
echo "LOGGED OUT";
session_destroy();
header('location: /forum/index.php?login=logout');


?>