<?php
    require_once './Modeles/json.php';

    class Sessions extends Json{

        public function __construct($FileName){
            parent::__construct($FileName);
        }

        public function set($user){
            $this->clear();
            $this->saveFile($user);
        }

        public function get(){
            if ($this->isActive()){
                return $this->loadFile();
            }
        }

        public function isActive(){
            $user= $this->loadFile();
            if (isset($user)){
                if ($user->id >0){
                    return true;
                }
            }
        }

        public function clear(){
            $this->clearContent();
        }
    }
?>