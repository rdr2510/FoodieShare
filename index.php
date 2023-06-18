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
                    case 'LIST_REPAS':
                        include('./Views/listRepas.php');                    
                        break;
                    case 'NEW_PROFIL':
                        include('./Views/addProfil.php');                    
                        break;
                }
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['menu'])){
                switch($_POST['menu']){
                    case 'LOGIN':
                        include('./Views/login.php');                    
                        break;
                    case 'LIST_REPAS':
                        include('./Views/listRepas.php');                    
                        break;
                    case 'NEW_PROFIL':
                        include('./Views/addProfil.php');                    
                        break;
                }
            }
        }           
    ?>    

    <?php include_once('./Views/addRepas.php') ?>
    
    <?php require_once('./Includes/footer.php') ?>
</body>

</html>