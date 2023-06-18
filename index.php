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
                        $titre= 'Oops! Échec de la connexion.';
                        $description= 'Erreur d\'authentification, votre nom d\'utilisateur et/ou mot de passe est incorrect.';
                        $resultat= 'Veuillez réessayer s\'il vous plaît...';
                        include('./Views/Failed.php');                              
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
                        $titre= 'Création de nouveau profil avec succées.';
                        $resultat= 'Veuillez connecter maintenant.';
                        include('./Views/Success.php');                    
                        break;
                    case 'PROFIL_FAILED':
                        $titre= 'Oops! Échec de la création de nouveau profil.';
                        $description= 'Erreur de création de nouveau profil, Il se peut que les informations que vous avez entrées existe déja dans notre base de donnée.';
                        $resultat= 'Veuillez réessayer s\'il vous plaît...';
                        include('./Views/Failed.php');                    
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