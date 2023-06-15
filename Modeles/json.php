<?php
    /** Classe qui permet de sauvegarder et de charger des listes array dans un fichier au format JSON */
    class Json{
        private $jsonFile= '';

        protected function __construct($jsonFile){
            $this->jsonFile= $jsonFile;
        }

        /**
         * Chargement de fichier JSON -­­> vers une variable tableau
         * @return {Array Associative}
         */
        protected function loadFile(){
            $j= file_get_contents($this->jsonFile);
            $listData= json_decode($j);
            if (empty($listData)){
                $listData=[];
            }
            return $listData;
        }

        /**
         * Sauvegarde de variable tableau associative -> vers fichier au format JSON
         * @param {Array Associative} 
         */
        protected function saveFile($listData){
            $j= json_encode($listData);
            file_put_contents($this->jsonFile, $j);
        }
    }
?>