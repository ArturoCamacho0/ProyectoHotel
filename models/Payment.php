<?php

class Payment{
    private $id;
    private $card_number;
    private $expiration;
    private $cvv;
    private $user_id;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);

        return $this;
    }

    public function getCard_number()
    {
        return $this->card_number;
    }

    public function setCard_number($card_number)
    {
        $this->card_number = $this->db->real_escape_string($card_number);

        return $this;
    }

    public function getExpiration()
    {
        return $this->expiration;
    }

    public function setExpiration($expiration)
    {
        $this->expiration = $this->db->real_escape_string($expiration);

        return $this;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    public function setCvv($cvv)
    {
        $this->cvv = $this->db->real_escape_string($cvv);

        return $this;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $this->db->real_escape_string($user_id);

        return $this;
    }

    public function get_allByUser(){
        $id = $this->getUser_id();
        $sql = "SELECT * FROM payment WHERE user_id = $id";

        $result = $this->db->query($sql);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function save(){
        $card_number = $this->getCard_number();
        $expiration = $this->getExpiration();
        $cvv = $this->getCvv();
        $user_id = $this->getUser_id();

        $sql = "INSERT INTO payment VALUES(
            NULL,
            '$card_number',
            '$expiration',
            '$cvv',
            $user_id
        );";

        $result = $this->db->query($sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function delete(){
        $id = $this->getId();

        $sql = "DELETE FROM payment WHERE id_payment = $id";

        $result = $this->db->query($sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }
}