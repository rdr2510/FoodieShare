<?php
    require_once './Modeles/json.php';

    class Repas extends Json{        
        private $listRepas= [];

        public function __construct($FileName){
            parent::__construct($FileName);
        }

        /**
         * Ajouter nouveau repas
         * @param {string} nom - nom du plat
         * @param {string} description - description ou detail du plat
         * @param {float} prix - prix unitaire du plat
         * @param {float} localisation
         */
        public function add(string $nom, string $description, float $prix, float $localisation){
            $this->listRepas= $this->loadFile(); 
            if (!empty($this->listRepas)){
                $id= count($this->listRepas) + 1;
            } else {
                $id=1 ;
            }
            array_push($this->listRepas, ['id'=>$id, 'nom'=>$nom, 'description'=>$description, 'prix'=>$prix, 'localisation'=>$localisation]);
            $this->saveFile($this->listRepas);
        }

        /**
         * lister tout les repas disponible
         * @return {Array Associative}
         */
        public function getAll(){
            $this->listRepas= $this->loadFile();
            return $this->listRepas;
        }

        /**
         * Charger un repas
         * @param {int} identifiant unique
         * @return {Array Associative}
         */
        public function get(int $id){
            $this->listRepas= $this->loadFile();
            $plat= array_map(function($plat) use ($id){
                if ($plat->id == $id){
                    return $plat;
                }
            }, $this->listRepas);
            return array_values(array_filter($plat))[0];
        }

        /**
         * recherche un repas
         * @param {string} word - text ou phrase a recherché
         * @param {int} critere - critere de recherche (0: toute les colonne, 1: par nom du plat seulement)
         * @return {Array Associative}
         */
        public function search($listRepas, string $word, int $critere= 0){
            //$this->listRepas= $this->loadFile();
            $listPlat= [];
            for ($i=0; $i<count($listRepas); ++$i){
                foreach($listRepas[$i] as $key => $value){
                    if ($critere==1)
                        if ($key=='nom')
                            $n=0;
                        else $n= 1;   
                    else
                        $n=0;

                    if ($n==0){
                        if (str_contains(strtolower($value), strtolower($word))){
                            array_push($listPlat, $listRepas[$i]);
                            break;       
                        }
                    }
                }
            }
            return $listPlat;
        }

        /**
         * critere de filtration de repas par prix
         * @param {float} min - prix minimum
         * @param {float} max - prix maximum
         * @return {Array Associative}
         */
        public function filtrePrix($listRepas, float $min=0, float $max=0){
            //$this->listRepas= $this->loadFile();
            $listPlat= [];
            for ($i=0; $i<count($listRepas); ++$i){
                if ($min <= $listRepas[$i]->prix && $listRepas[$i]->prix <= $max){
                    array_push($listPlat, $listRepas[$i]);
                }
            }
            return $listPlat;
        }

        /**
         * critere de filtration de repas par localisation
         * @param {float} min - distance minimum
         * @param {float} max - distance maximum
         * @return {Array Associative}
         */
        public function filtreLocalisation($listRepas, float $min=0, float $max=0){
            //$this->listRepas= $this->loadFile();
            $listPlat= [];
            for ($i=0; $i<count($listRepas); ++$i){
                if ($min <= $listRepas[$i]->localisation && $listRepas[$i]->localisation <= $max){
                    array_push($listPlat, $listRepas[$i]);
                }
            }
            return $listPlat;
        }
    }

?>