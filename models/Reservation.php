<?php

class Reservation{
    private $id;
    private $room_id;
    private $payment_id;

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

    public function getRoom_id()
    {
        return $this->room_id;
    }

    public function setRoom_id($room_id)
    {
        $this->room_id = $this->db->real_escape_string($room_id);

        return $this;
    }

    public function getPayment_id()
    {
        return $this->payment_id;
    }

    public function setPayment_id($payment_id)
    {
        $this->payment_id = $this->db->real_escape_string($payment_id);

        return $this;
    }

    public function get_all(){
        $id = $this->getId();

        $sql = "SELECT room.id_room, room.image_room, room.name_room, room.size_room,
                room.extra_room, payment.card_number, room.price_room, reservation.id_reservation
                FROM reservation
                INNER JOIN room ON room.id_room = reservation.room_id
                INNER JOIN payment ON payment.id_payment = reservation.payment_id
                INNER JOIN user ON user.id_user = payment.user_id
                WHERE user.id_user = $id
                ORDER BY reservation.id_reservation DESC;";

        $result = $this->db->query($sql);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function get_payment(){
        $sql = "SELECT * FROM payment ORDER BY id_payment DESC LIMIT 1";

        $query = $this->db->query($sql);

        $payment_id = $query->fetch_object()->id_payment;

        return $payment_id;
    }

    public function save(){
        $room_id = $this->getRoom_id();
        $payment_id = $this->getPayment_id();

        $sql = "INSERT INTO reservation VALUES(
            NULL,
            $room_id,
            $payment_id
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

        $sql = "DELETE FROM reservation WHERE id_reservation = $id";

        $result = $this->db->query($sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }
}