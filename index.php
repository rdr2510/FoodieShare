<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('./Includes/head.php') ?>
    <title>FOODIE SHARE</title>
</head>

<body>
    <?php require_once('./Includes/header.php') ?>
    
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['menu'])){
                switch($_GET['menu']){
                    case 'LOGIN':
                        include('./Views/login.php');                    
                        break;
                    case 'REPAS':
                        include('./Views/repas.php');                    
                        break;
                }
            }
        }
    ?>    
    <?php include('./Views/addRepas.php') ?>
    
    <?php require_once('./Includes/footer.php') ?>
</body>

</html>