<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('./Includes/head.php') ?>
    <title>Document</title>
</head>
<body>
    <?php require_once('./Includes/header.php') ?>

    <?php
        include('./Modeles/repas.php');
        $r= new Repas('./Data/Repas.json');
        print_r($r->search('special', 0));        
    ?>

    <?php require_once('./Includes/footer.php') ?>
</body>
</html>