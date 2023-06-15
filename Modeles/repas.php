<?php
    include './Modeles/json.php';

    class Repas extends Json{        
        private $listRepas= [];

        public function __construct($FileName){
            parent::__construct($FileName);
        }

        
    }

?>