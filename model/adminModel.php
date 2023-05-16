<?php
    include "../include/dbCon.php";
    
    $method = $_POST['method'];

    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not exist";
    }
function fnAddProduct(){
    global $con;
    $product_name = $_POST['product_name'];
    $product_price = $_POST['price'];
    $product_newPrice = $_POST['new_price'];
    $product_brand = $_POST['brand'];
    $product_variant = $_POST['color'];
    $product_stock = $_POST['vstock'];
    $product_spec = $_POST['product_spec'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];
    $files = $_FILES['product_picture']['name'];
    $folder = "../images/" . $product_category . '/';
    $destination = $folder . $files;
    $product_id = $_POST['product_id'];
    $query = $con->prepare('CALL sp_addUpdateProduct(?,?,?,?,?,?,?,?,?,?,?)');
    $query->bind_param('ssssiisissi',$product_brand,$product_name,$product_description,$product_spec,$product_price,$product_newPrice,$product_variant,$product_stock,$product_category,$files,$product_id);
    
    if($query->execute()){
        move_uploaded_file($_FILES['product_picture']['tmp_name'],$destination);
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}
function fnGetItems(){
    global $con;
    $productid = $_POST['productid'];

    $query = $con->prepare('CALL sp_getProduct(?)');
    $query->bind_param('i',$productid);
    
    $query->execute();
    $result = $query->get_result();
    $data = array();
    while($row = $result->fetch_array()){
        $data[] = $row;
    }

    echo json_encode($data);
}
function fnDeleteItem(){
    global $con;
    $productid = $_POST['productid'];

    $query = $con->prepare('CALL sp_deleteItem(?)');
    $query->bind_param('i',$productid);
    
    if($query->execute()){
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}
function fnGetUser(){
    global $con;
    $userid = $_POST['userid'];

    $query = $con->prepare('CALL sp_getUser(?)');
    $query->bind_param('i',$userid);

    $query->execute();
    $result = $query->get_result();
    $data = array();
    while($row = $result->fetch_array()){
        $data[] = $row;
    }

    echo json_encode($data);
}
function fnUpdateUser(){
    global $con;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $gender = $_POST['gender'];
    $roles = $_POST['roles'];
    $status = $_POST['status'];
    $isactive = $_POST['isactive'];
    $userid = $_POST['userid'];
 
    $query = $con->prepare('CALL sp_updateUser(?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $query->bind_param('sssssssisiiii',$username,$email,$firstname,$lastname,$street,$city,$state,$zipcode,$gender,$roles,$status,$isactive,$userid);
    
    if($query->execute()){
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}
function fnGetCustomer(){
    global $con;
    $userid = $_POST['userid'];

    $query = $con->prepare('CALL sp_getCustomer(?)');
    $query->bind_param('i',$userid);

    $query->execute();
    $result = $query->get_result();
    $data = array();
    while($row = $result->fetch_array()){
        $data[] = $row;
    }

    echo json_encode($data);
}
function fnGetCustomerPurchased(){
    global $con;
    $userid = $_POST['id'];

    $query = $con->prepare('CALL sp_getCustomerPurchased(?)');
    $query->bind_param('i',$userid);

    $query->execute();
    $result = $query->get_result();
    $data = array();
    while($row = $result->fetch_array()){
        $data[] = $row;
    }

    echo json_encode($data);
}
function fnUpdateSales(){
    global $con;
    $id = $_POST['userid'];
    $pid = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['tprice'];
    $status = $_POST['status'];

    $query = $con->prepare('CALL sp_updateSales(?,?,?,?,?)');
    $query->bind_param('iiiis',$id,$pid,$quantity,$price,$status);

    if($query->execute()){
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}
?>