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
                        $_POST['action']= 'ADD';
                        include('./Views/Profil.php');                    
                        break;
                    case 'LOGIN_FAILED':
                        include('./Views/loginFailed.php');                    
                        break;
                    case 'VIEW_PROFIL':
                        require_once('./Modeles/users.php');
                        $users= new Users('./Datas/Users.json');
                        $user= $users->get($_GET['userId']);
                        $_POST['nom']= $user->nom;
                        $_POST['prenom']= $user->prenom;
                        $_POST['username']= $user->username;
                        $_POST['password']= $user->password;
                        $_POST['action']= 'VIEW';
                        include('./Views/Profil.php');                    
                        break;
                    case 'PROFIL_SUCCESS':
                        include('./Views/profilSuccess.php');                    
                        break;
                    case 'PROFIL_FAILED':
                        include('./Views/profilFailed.php');                    
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
                        include('./Views/Profil.php');                    
                        break;
                }
            }
        }           
    ?>    

    <?php include_once('./Views/addRepas.php') ?>
    
    <?php require_once('./Includes/footer.php') ?>
</body>

</html>