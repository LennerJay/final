<?php 
    include "backend.php";
    session_start();
    $method = $_POST['method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not exist";
    }
    function getVariant(){
        $backend = new Backend();
        echo $backend->getVariant($_POST['id']);
    }
    function fnGetUser(){
        $backend = new Backend;
        echo $backend->fnGetUser();
    }
    function fnRegister(){
        $backend = new Backend;
        $files = $_FILES['profile_picture']['name'];
        $folder = "../images/profile/";
        $destination = $folder . $files;
        $result = $backend->fnRegister($_POST['username'],$_POST['firstname'],$_POST['lastname'],$_POST['street'],$_POST['city'],$_POST['state'],$_POST['zipcode'],$_POST['age'],$_POST['gender'],$_POST['email'],md5($_POST['password']),$files,$_POST['userid']);
        if($result === 1){
        move_uploaded_file($_FILES['profile_picture']['tmp_name'],$destination);
            echo 1;
        }else{
            echo 2;
        }
    }
    function checkStatus(){
        if(isset($_SESSION['email']) && $_SESSION['password']){
            echo 1;
        }else{
            echo 2;
        }
    }
    function updateQuantity(){
        if(isset($_SESSION['email']) && isset( $_SESSION['password'])){
            $backend = new Backend();
            echo $backend->updateQuantity($_SESSION['user_id'],$_POST['product_id'],$_POST['quantity']);
        }else{
            echo 2;
        }
    }
    function getPurchasedProduct(){
        if(isset($_SESSION['email']) && isset( $_SESSION['password'])){
            $backend = new Backend();
            echo $backend->fnGetPurchasedProduct($_SESSION['user_id']);
        }else{
            echo 2;
        }
    }
    function fnPurchase(){
        if(isset($_SESSION['email']) && isset( $_SESSION['password'])){
            $backend = new Backend();
            // echo $_SESSION['user_id'];
            echo $backend->fnPurchase($_SESSION['user_id'],$_POST['product_id'],$_POST['quantity'],"Pending");
        }else{
            echo 2;
        }
    }
    function getShoppingCart(){
        if(isset($_SESSION['email']) && isset( $_SESSION['password'])){
            $backend = new Backend;
            echo $backend->getShoppingCart($_SESSION['user_id']);
        }else{
            echo 2;
        }

    }
    function fnAddToCart(){
        if(isset($_SESSION['email']) && isset( $_SESSION['password'])){
            $backend = new Backend();
            echo $backend->addToCart($_SESSION['user_id'],$_POST['product_id'],0);
        }else{
            echo 2;
        }

    }
    function fnLogIn(){
        $backend = new Backend();
        $result = $backend->login($_POST['email'],$_POST['password']);
        $ret=[];
        if($result['ret'] == 1){
            $_SESSION['email'] = $result['email'];
            $_SESSION['password'] = $result['password'];
            $_SESSION['user_id'] = $result['userid'];
            $_SESSION['role'] = $result['role'];
            $ret = ['ret'=>$result['ret'],'user_role'=>$result['role']];

            $_SESSION['username'] = $result['username'];
            $_SESSION['firstname'] = $result['firstname'];
            $_SESSION['lastname'] = $result['lastname'];
            $_SESSION['age'] = $result['age'];
            $_SESSION['gender'] = $result['gender'];
            $_SESSION['street'] = $result['street'];
            $_SESSION['city'] = $result['city'];
            $_SESSION['state'] = $result['state'];
            $_SESSION['zipcode'] = $result['zipcode'];
        }else{
            $ret =  ['ret'=>$result['ret']];
        }
        echo json_encode($ret);
    }

    function register(){
        $backend = new Backend();
        echo $backend->register($_POST['username'],$_POST['password'],$_POST['email']);

    }   
    function fnAddProduct(){
        $folder = '../images/' . $_POST['product_category'] . '/';
        $filename = $_FILES['product_img']['name'];
        $destination = $folder . $filename;
        $backend = new Backend();
        $result = $backend->addProduct($_POST['product_brand'],$_POST['product_name'],$_POST['product_description'],$_POST['product_specification'],$_POST['product_oldPrice'],$_POST['product_newPrice'],$_POST['product_stock'],
        0,
        $filename,
        $_POST['product_category']);
        if($result === 1){
            move_uploaded_file($_FILES['product_img']['tmp_name'],$destination);
            echo $result;
        }else{
            echo $result;
        }
    }
    function getProduct(){
        $backend = new Backend();
        echo $backend->getProduct($_POST['productId']);
    }
    function logout(){
        session_unset();
        session_destroy();
        echo 1;
    }

?>