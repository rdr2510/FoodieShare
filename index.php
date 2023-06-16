<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('./Includes/head.php') ?>
    <title>Document</title>
</head>

<body>
    <?php require_once('./Includes/header.php') ?>

    <?php
    include('./Modeles/users.php');

    $user = new Users('./Data/Etudiants.json');
    $user->add('RAKOTO', 'LIVA', 'liva', '123456');

    ?>

    <?php require_once('./Includes/footer.php') ?>
</body>

</html>