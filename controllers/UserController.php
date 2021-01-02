<?php
require_once 'models/User.php';

class UserController{
    public function index(){
        Utils::isLogged();

        if(isset($_SESSION['identity'])){
            $id = $_SESSION['identity']->id_user;

            $user = new User;
            $user->setId($id);
            $user = $user->getOne();
        }
        require_once 'views/user/index.php';
    }

    public function login_view(){
        require_once 'views/user/login.php';
    }

    public function register(){
        require_once 'views/user/register.php';
    }

    public function update_view(){
        if(isset($_GET['id'])){
            $user = new User;
            $user->setId($_GET['id']);
            $user = $user->getOne();
        }
        require_once 'views/user/update.php';
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

                if(isset($_FILES)){
                    $file = $_FILES['image'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png"
                    || $mimetype == "image/png" || $mimetype == "image/gif"){
                        if(!is_dir('uploads/images')){
                            mkdir("uploads/images", 0777, true);
                        }

                        move_uploaded_file($file['tmp_name'], "uploads/images/".$filename);
                        $user->setImage($filename);
                    }
                }

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

    public function update(){
        if(isset($_POST)){
            $id = $_POST['id'];
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : false;
            $gender = isset($_POST['gender']) ? $_POST['gender'] : false;
            $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;

            $date = str_replace('/', '-', $birthdate);
            $date = date('Y-m-d', strtotime($date));

            if($id && $name && $lastName && $gender && $birthdate && $email){
                $user = new User;

                $user->setId($id);
                $user->setName($name);
                $user->setLastName($lastName);
                $user->setGender($gender);
                $user->setBirthdate($date);
                $user->setEmail($email);

                // Guardar la imagen
                if(isset($_FILES)){
                    $file = $_FILES['image'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png"
                    || $mimetype == "image/png" || $mimetype == "image/gif"){
                        if(!is_dir('uploads/images')){
                            mkdir("uploads/images", 0777, true);
                        }

                        move_uploaded_file($file['tmp_name'], "uploads/images/".$filename);
                        $user->setImage($filename);
                    }
                }

                $save = $user->update();

                if($save){
                    $_SESSION['update'] = "complete";
                }else{
                    $_SESSION['update'] = "failed";
                }

                header("Location: ".base_url."user/index");
            }else{
                $_SESSION['update'] = "failed";
                header("Location: ".base_url."user/update_view");
            }
        }else{
            $_SESSION['update'] = "failed";
            header("Location: ".base_url."user/index");
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

                if($identity->role_user == "admin"){
                    $_SESSION['admin'] = true;
                }

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
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }else if(isset($_SESSION['error_login'])){
            unset($_SESSION['error_login']);
        }

        header("Location: ".base_url);
    }
}