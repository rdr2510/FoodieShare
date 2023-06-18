<?php
    require_once './Modeles/json.php';

    class Avis extends Json{        
        private $listAvis= [];

        public function __construct($FileName){
            parent::__construct($FileName);
        }

        /**
         * Ajouter nouveau avis ou commentaire
         * @param {int} userId - identifiant unique de l'utilisateur
         * @param {int} note - attribution de note du plat
         * @param {string} description - commentaire ou avis de l'utilisateur pour a propos du plat
         */
        public function add(int $userId, int $note, string $description){
            $this->listAvis= $this->loadFile(); 
            if (!empty($this->listAvis)){
                $id= count($this->listAvis) + 1;
            } else {
                $id=1 ;
            }
            array_push($this->listAvis, ['id'=>$id, 'userId'=>$userId, 'note'=>$note,'description'=>$description]);
            $this->saveFile($this->listAvis);
        }

        /**
         * lister tout les avis ou commentaire
         * @param {int} userId - identifiant unique de l'utilisateur
         * @return {Array Associative}
         */
        public function getAll(int $userId){
            $this->listAvis= $this->loadFile();
            $listDescription= [];
            for ($i=0; $i<count($this->listAvis); ++$i){
                if ($this->listAvis[$i]->userId == $userId){
                    array_push($listDescription, $this->listAvis[$i]);
                }
            }
            return $listDescription;
        }

        /**
         * Afficher un avis
         * @param {int} identifiant unique
         * @return {Array Associative}
         */
        public function get(int $id){
            $this->listAvis= $this->loadFile();
            $avis= array_map(function($avis) use ($id){
                if ($avis->id == $id){
                    return $avis;
                }
            }, $this->listAvis);
            return array_values(array_filter($avis))[0];
        }
    }

?>