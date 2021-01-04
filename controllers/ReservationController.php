<?php

require_once 'models/Reservation.php';
require_once 'models/Room.php';

class ReservationController{
    public function index(){
        $id = $_SESSION['identity']->id_user;
        $reservation = new Reservation;
        $reservation->setId($id);
        $reservations = $reservation->get_all();

        require_once 'views/reservation/index.php';
    }

    public function create(){
        if(isset($_SESSION['id_room']) && isset($_GET['id_payment'])){
            $reservation = new Reservation;

            $room_id = $_SESSION['id_room'];
            $payment_id = $_GET['id_payment'];

            $reservation->setRoom_id($room_id);
            $reservation->setPayment_id($payment_id);
            $result = $reservation->save();

            if($result){
                unset($_SESSION['id_room']);
                unset($_SESSION['payment']);
                $_SESSION['reservation'] = "complete";
                header("Location: ".base_url."reservation/index");
            }else{
                $_SESSION['reservation'] = "failed";
                header("Location: ".base_url."room/detail&id=".$room_id);
            }
        }else{
            $_SESSION['reservation'] = "failed";
            header("Location: ".base_url);
        }
    }


    public function delete(){
        if($_GET['id']){
            $id = $_GET['id'];

            $reservation = new Reservation;
            $reservation->setId($id);
            $result = $reservation->delete();

            if($result){
                $_SESSION['reservation_delete'] = "success";
            }else{
                $_SESSION['reservation_delete'] = "failed";
            }

            header("Location: ".base_url."reservation/index");
        }else{
            $_SESSION['reservation_delete'] = "failed";
            header("Location: ".base_url."reservation/index");
        }
    }
}