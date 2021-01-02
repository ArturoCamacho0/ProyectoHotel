<?php

require_once 'models/Room.php';

class RoomController{
    public function index(){
        $room = new Room();
        $rooms = $room->get_all();

        require_once 'views/room/index.php';
    }

    public function create(){
        Utils::isAdmin();
        require_once 'views/room/create.php';
    }

    public function save(){
        Utils::isAdmin();

        if(isset($_POST)){
            $name = isset($_POST["name"]) ? $_POST["name"] : false;
            $description = isset($_POST["description"]) ? $_POST["description"] : false;
            $size = isset($_POST["size"]) ? $_POST["size"] : false;
            $price = isset($_POST["price"]) ? $_POST["price"] : false;
            $extra = isset($_POST["extra"]) ? $_POST["extra"] : '';

            if($name && $description && $size && $price && $extra){
                $room = new Room;

                $room->setName($name);
                $room->setDescription($description);
                $room->setSize($size);
                $room->setPrice($price);
                $room->setExtra($extra);

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
                        $room->setImage($filename);
                    }
                }

                $result = $room->save();

                if($result){
                    $_SESSION['room_add'] = "complete";
                    header("Location: ".base_url."room/index");
                }else{
                    $_SESSION['room_add'] = "failed";
                    header("Location: ".base_url."room/create");
                }
            }else{
                $_SESSION['room_add'] = "failed";
                header("Location: ".base_url."room/create");
            }
        }
    }

    public function detail(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $room = new Room;
            $room->setId($id);
            $room = $room->get_one();

            if($room){
                require_once 'views/room/detail.php';
            }else{
                var_dump($room);
            }
        }
    }
}