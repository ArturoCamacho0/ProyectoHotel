<?php

class User{
    private $id;
    private $name;
    private $lastname;
    private $gender;
    private $birthdate;
    private $email;
    private $password;
    private $image;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }
    
    // Getters y Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $this->db->real_escape_string($name);

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $this->db->real_escape_string($lastname);

        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $this->db->real_escape_string($gender);

        return $this;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $this->db->real_escape_string($birthdate);

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);

        return $this;
    }

    public function getPassword()
    {
        return password_hash(
            $this->db->real_escape_string($this->password),
            PASSWORD_BCRYPT,
            ['cost' => 4]
        );
    }

    public function setPassword($password)
    {
        $this->password = $this->db->real_escape_string($password);

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $this->db->real_escape_string($image);

        return $this;
    }

    public function getOne(){
        $id = $this->getId();

        $sql = "SELECT * FROM user WHERE id_user = $id";

        $user = $this->db->query($sql);

        if($user){
            return $user->fetch_object();
        }else{
            return false;
        }
    }

    /* Registro de usuario */
    public function save(){
        $name = $this->getName();
        $lastname = $this->getLastname();
        $gender = $this->getGender();
        $birthdate = $this->getBirthdate();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $image = $this->getImage();

        $sql = "INSERT INTO user VALUES(
            NULL,
            '$name',
            '$lastname',
            '$gender',
            '$birthdate',
            '$email',
            '$password',
            '$image',
            'user'
        )";

        $save = $this->db->query($sql);

        if($save){
            return true;
        }else{
            return false;
        }
    }

    /* Actualización del usuario */
    public function update(){
        $id = $this->getId();
        $name = $this->getName();
        $lastname = $this->getLastname();
        $gender = $this->getGender();
        $birthdate = $this->getBirthdate();
        $email = $this->getEmail();
        $image = $this->getImage();

        $sql = " UPDATE `user`
            SET `name_user` = '$name',
            `lastname_user` = '$lastname',
            `gender_user` = '$gender',
            `birthdate`= '$birthdate',
            `email_user` = '$email' ";

        if($image != null){
            $sql .= ", `image_user` = '$image' ";
        }

        $sql .= "WHERE id_user = $id";

        $save = $this->db->query($sql);

        if($save){
            return true;
        }else{
            return false;
        }
    }

    /* LOGIN */
    public function login(){
        $email = $this->email;
        $password = $this->password;

        // Comprobar si existe el usuario
        $sql = "SELECT * FROM user WHERE email_user = '$email'";

        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $user = $login->fetch_object();

            // Veríficar contraseña
            $verify = password_verify($password, $user->password_user);

            if($verify){
                $result = $user;
            }else{
                return $this->db->error." | ".$verify." | ".$sql;
            }

        }else{
            return $this->db->error." | ".$sql;
        }

        return $result;
    }
}