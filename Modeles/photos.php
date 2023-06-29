<?php
    require_once './Modeles/json.php';

    class Photos extends Json{        
        private $listPhoto= [];

        public function __construct($FileName){
            parent::__construct($FileName);
        }

        /**
         * Ajouter nouveau photo
         * @param {int} platId - identifiant unique du plat
         * @param {int} userId - identifiant unique de l'utilisateur
         * @param {string} urlPhoto - url de photo
         */
        public function add(int $platId, int $userId, string $urlPhoto){
            $this->listPhoto= $this->loadFile(); 
            if (!empty($this->listPhoto)){
                $id= count($this->listPhoto) + 1;
            } else {
                $id=1 ;
            }
            array_push($this->listPhoto, ['id'=>$id, 'platId'=>$platId, 'userId'=>$userId, 'urlPhoto'=>$urlPhoto]);
            $this->saveFile($this->listPhoto);
        }

        /**
         * lister tout les photos postés par les utilisateurs
         * @param {int} platId - identifiant unique du plat
         * @param {int} userId - identifiant unique de l'utilisateur
         * @return {Array Associative}
         */
        public function getAll(int $platId, int $userId){
            $this->listPhoto= $this->loadFile();
            $listPicture= [];
            for ($i=0; $i<count($this->listPhoto); ++$i){
                if ($this->listPhoto[$i]->platId == $platId && $this->listPhoto[$i]->userId == $userId){
                    array_push($listPicture, $this->listPhoto[$i]);
                }
            }
            return $listPicture;
        }

        /**
         * Afficher une photo
         * @param {int} identifiant unique
         * @return {Array Associative}
         */
        public function get(int $id){
            $this->listPhoto= $this->loadFile();
            $photo= array_map(function($photo) use ($id){
                if ($photo->id == $id){
                    return $photo;
                }
            }, $this->listPhoto);
            return array_values(array_filter($photo))[0];
        }
    }
?>