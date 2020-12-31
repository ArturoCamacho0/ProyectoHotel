<?php
require_once 'models/User.php';

class UserController{
    public function index(){
        require_once 'views/user/index.php';
    }

    public function login_view(){
        require_once 'views/user/login.php';
    }

    public function register(){
        if(isset($_SESSION['identity'])){
            header("Location: ".base_url);
        }
        require_once 'views/user/register.php';
    }

    public function save(){
        if(isset($_POST)){
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : false;
            $gender = isset($_POST['gender']) ? $_POST['gender'] : false;
            $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            $date = str_replace('/', '-', $birthdate);
            $date = date('Y-m-d', strtotime($date));

            if($name && $lastName && $gender && $birthdate && $email && $password){
                $user = new User;

                $user->setName($name);
                $user->setLastName($lastName);
                $user->setGender($gender);
                $user->setBirthdate($date);
                $user->setEmail($email);
                $user->setPassword($password);

                $save = $user->save();

                if($save){
                    $_SESSION['register'] = "complete";
                }else{
                    $_SESSION['register'] = "failed";
                }

                header("Location: ".base_url."user/login");
            }else{
                $_SESSION['register'] = "failed";
                header("Location: ".base_url."user/register");
            }
        }else{
            $_SESSION['register'] = "failed";
            header("Location: ".base_url."user/register");
        }
    }

    public function login(){
        if(isset($_POST)){
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if($email && $password){
                $user = new User;

                $user->setEmail($email);
                $user->setPassword($password);

                $identity = $user->login();

                if($identity && is_object($identity)){
                    $_SESSION['identity'] = $identity;

                    if(isset($_SESSION['error_login'])){
                        unset($_SESSION['error_login']);
                    }

                    header("Location: ".base_url);
                }else{
                    $_SESSION['error_login'] = "Identificación fallida";
                    header("Location: ".base_url."user/login_view");
                }

            }else{
                $_SESSION['error_login'] = "Identificación fallida";
                header("Location: ".base_url."user/login_view");
            }

        }else{
            $_SESSION['error_login'] = "Identificación fallida";
            header("Location: ".base_url."user/login_view");
        }
    }

    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }else if(isset($_SESSION['error_login'])){
            unset($_SESSION['error_login']);
        }

        header("Location: ".base_url);
    }

    public function detail(){
        require_once 'views/user/detail.php';
    }
}