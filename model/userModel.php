<?php
    include "../include/dbCon.php";
    
    $method = $_POST['method'];

    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not exist";
    }

function fnRegister(){
    global $con;
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $files = $_FILES['profile_picture']['name'];
    $folder = "../images/profile/";
    $destination = $folder . $files;
    $userid = $_POST['userid'];
    $query = $con->prepare('CALL sp_saveUser(?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $query->bind_param('ssssssiissssi',$username,$firstname,$lastname,$street,$city,$state,$zipcode,$age,$gender,$email,$password,$files,$userid);
    
    if($query->execute()){
        move_uploaded_file($_FILES['profile_picture']['tmp_name'],$destination);
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}
function fnLogin(){
    global $con;
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $query = $con->prepare('CALL sp_checkUser(?,?)');
    $query->bind_param('ss',$email,$password);
    $query->execute();
    $result = $query->get_result();
    $ret = '';
    while ($row = $result->fetch_array()) {

        if($row['ret'] == 1){
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['fullname'] = $row['firstname'] . $row['lastname'];
            $_SESSION['role'] = $row['role'];
        }
        $ret = $row['ret'];
    }
    echo $ret;
}
function checkStatus(){
        if(isset($_SESSION['username'])){
            echo 1;
        }else{
            echo 2;
        }
    }
?>