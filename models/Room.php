<?php

class Room{
    private $id;
    private $name;
    private $description;
    private $size;
    private $price;
    private $extra;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $this->db->real_escape_string($description);

        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $this->db->real_escape_string($size);

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $this->db->real_escape_string($price);

        return $this;
    }

    public function getExtra()
    {
        return $this->extra;
    }

    public function setExtra($extra)
    {
        $this->extra = $this->db->real_escape_string($extra);

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

    public function get_all(){
        $sql = "SELECT * FROM room ORDER BY id_room DESC;";

        $result = $this->db->query($sql);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function get_one(){
        $id = $this->getId();

        $sql = "SELECT * FROM room WHERE id_room = $id";

        $result = $this->db->query($sql);
        
        if($this->db->error){
            return $this->db->error;
        }

        if($result){
            return $result->fetch_object();
        }else{
            return false;
        }
    }

    public function get_allByUser($id){
        $user_id = $id;

        $sql = "SELECT room.*
                FROM payment
                INNER JOIN reservation ON reservation.payment_id = payment.id_payment
                INNER JOIN room ON room.id_room = reservation.room_id
                WHERE payment.user_id = $user_id";

        $result = $this->db->query($sql);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function save(){
        $name = $this->getName();
        $description = $this->getDescription();
        $size = $this->getSize();
        $price = $this->getPrice();
        $extra = $this->getExtra();
        $image = $this->getImage();

        $sql = "INSERT INTO room VALUES(
            NULL,
            '$name',
            '$description',
            $size,
            $price,
            '$extra',
            '$image'
        );";

        $save = $this->db->query($sql);

        if($save){
            return true;
        }else{
            return false;
        }
    }

    public function delete(){
        $id = $this->getId();

        $sql = "DELETE FROM room WHERE id_room = $id";

        $result = $this->db->query($sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }
}