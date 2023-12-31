<?php
    require_once './Modeles/json.php';

    class Users extends Json{        
        private $listUser= [];

        public function __construct($FileName){
            parent::__construct($FileName);
        }
        
        /**
         * Ajouter nouveau utilisateur
         * @param {string} nom - nom de l'etudiant
         * @param {string} prenom - prenom de l'etudiant
         * @param {string} username - nom d'utilisateur de l'etudiant
         * @param {string} password - mot de passe de l'etudiant
         */
        public function add(string $nom, string $prenom, string $username, string $password){
            $this->listUser= $this->loadFile(); 
            if (!empty($this->listUser)){
                $id= count($this->listUser) + 1;
            } else {
                $id=1 ;
            }
            array_push($this->listUser, ['id'=>$id, 'nom'=>$nom, 'prenom'=>$prenom, 'username'=>$username, 'password'=>$password]);
            $this->saveFile($this->listUser);
        }

        /**
         * Charger un etudiant en specifiant son identifiant
         * @param {int} identifiant unique
         * @return {Array Associative}
         */
        public function get(int $id){
            $this->listUser= $this->loadFile();
            $user= array_map(function($user) use ($id){
                if ($user->id == $id){
                    return $user;
                }
            }, $this->listUser);
            return array_values(array_filter($user))[0];
        }

        /**
         * Teste l'existence d'un utilisateur dans la base de donnée
         * @param {string} nom - Nom de l'utilisateur
         * @param {string} prenom - Prenom de l'utlisateur
         * @param {string} username - nom d'utilisateur
         * @return {Boolean}
         */
        public function isExist(string $nom, string $prenom, string $username){
            $this->listUser= $this->loadFile();
            for($i=0; $i<count($this->listUser); ++$i){
                $user= $this->listUser[$i];
                if (strtolower($user->nom) == strtolower($nom) && strtolower($user->prenom) == strtolower($prenom)){
                    return true;
                    break;
                } else if (strtolower($user->username) == strtolower($username)){
                    return true;
                    break;
                }
            }
        }
        
        /**
         * Modifier un etudiant
         * @param {int} id - identifiant unique
         * @param {string} nom - nom de l'etudiant
         * @param {string} prenom - prenom de l'etudiant
         * @param {string} username - nom d'utilisateur de l'etudiant
         * @param {string} password - mot de passe de l'etudiant
         */
        public function update(int $id, string $nom, string $prenom, string $username, string $password){
            $user= $this->get($id);
            $index= array_search($user, $this->listUser);
            $user->nom= $nom;
            $user->prenom= $prenom;
            $user->username= $username;
            $user->password= $password;
            $this->listUser[$index]= $user;
            $this->saveFile($this->listUser);
        }

        /**
         * Verifier le nom de l'utilisateur et le mot de passe
         * @param {string} username - nom d'utilisateur de l'etudiant
         * @param {string} password - mot de passe de l'etudiant
         * @return {int} identification unique
         */
        public function login(string $username, string $password){
            $this->listUser= $this->loadFile();
            $user= array_filter($this->listUser, function($user) use ($username, $password){
                return ($user->username == $username && $user->password == $password);
            });
            $user= array_values(array_filter($user))[0];
            if ($user){
                return $user->id;
            } else {
                return -1;
            }
        }
    }
?>