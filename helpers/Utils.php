<?php

class Utils{
    public static function isLogged(){
        if(isset($_SESSION['identity'])){
            return true;
        }else{
            header('Location: '.base_url);
        }
    }

    public static function isAdmin(){
        if(isset($_SESSION['admin'])){
            return true;
        }else{
            header('Location: '.base_url);
        }
    }
}