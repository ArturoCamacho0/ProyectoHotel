<?php

class Utils{
    public static function isLogged(){
        if(isset($_SESSION['identity'])){
            return true;
        }else{
            header('Location: '.base_url);
        }
    }
}