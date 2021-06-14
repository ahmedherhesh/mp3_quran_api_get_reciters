<?php
include "functions.php";
$id = isset($_GET['id']) ? $_GET['id'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>الصفحة الرئيسية</title>
</head>
<body>
    <?php
        // getCount($id);
        //getSuras($id);
        $suras = new Quran_Player();
        $suras->getReciter($id);
        echo $suras->getCount();
    ?>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
</body>
</html>