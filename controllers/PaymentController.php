<?php

require_once 'models/User.php';
require_once 'models/Payment.php';

class PaymentController{
    public function index(){
        require_once 'views/payment/index.php';
    }

    public function create(){
        Utils::isLogged();
        require_once 'views/payment/create.php';
    }

    public function save(){
        if(isset($_POST)){
            $card_number = isset($_POST['card_number']) ? $_POST['card_number'] : false;
            $expiration_month = isset($_POST['expiration_month']) ? $_POST['expiration_month'] : false;
            $expiration_year = isset($_POST['expiration_year']) ? $_POST['expiration_year'] : false;
            $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : false;

            $user = isset($_SESSION['identity']) ? $_SESSION['identity'] : false;
            $user_id = $user->id_user;

            if($card_number && $expiration_month && $expiration_year && $cvv && $user_id){
                $expiration = $expiration_month."/".$expiration_year;

                $payment = new Payment;
                $payment->setCard_number($card_number);
                $payment->setExpiration($expiration);
                $payment->setCvv($cvv);
                $payment->setUser_id($user_id);

                $result = $payment->save();

                if($result){
                    $_SESSION['payment'] = "complete";
                    header("Location: ".base_url."payment/show");
                }else{
                    $_SESSION['payment'] = "failed";
                    header("Location: ".base_url."payment/create");
                }
            }else{
                $_SESSION['payment'] = "failed";
                header("Location: ".base_url."payment/create");
            }
        }else{
            $_SESSION['payment'] = "failed";
            header("Location: ".base_url."payment/create");
        }
    }

    public function show(){
        Utils::isLogged();

        if(isset($_GET['id_room'])){
            $_SESSION['id_room'] = $_GET['id_room'];
            
        }

        if($_SESSION['identity']){
            $user = $_SESSION['identity'];
            $id = $user->id_user;

            $payment = new Payment;
            $payment->setUser_id($id);
            $payments = $payment->get_allByUser();

            require_once 'views/payment/payments.php';
        }
    }

    public function delete(){
        if($_GET['id']){
            $id = $_GET['id'];

            $payment = new Payment;
            $payment->setId($id);
            $result = $payment = $payment->delete();

            if($result){
                $_SESSION['payment_delete'] = "success";
            }else{
                $_SESSION['payment_delete'] = "failed";
            }
        }else{
            $_SESSION['payment_delete'] = "failed";
        }
        header("Location: ".base_url."payment/show");
    }
}