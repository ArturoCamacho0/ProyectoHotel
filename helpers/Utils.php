<?php

class Utils{
    public static function isLogged(){
        if(isset($_SESSION['identity'])){
            return true;
        }else{
            echo'<script type="text/javascript">
                alert("Inicia sesión primero");
                window.location.href="'.base_url.'";
                </script>';
        }
    }

    public static function isAdmin(){
        if(isset($_SESSION['admin'])){
            return true;
        }else{
            echo'<script type="text/javascript">
                alert("No eres administrador");
                window.location.href="index.php";
                </script>';
        }
    }
}