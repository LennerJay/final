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
    $query = $con->prepare('CALL sp_addUpdateProduct(?,?,?,?,?,?,?,?,?,?)');
    $query->bind_param('ssssisissi',$product_brand,$product_name,$product_description,$product_spec,$product_price,$product_variant,$product_stock,$product_category,$files,$product_id);
    
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
    $roles = $_POST['roles'];
    $status = $_POST['status'];
    $isactive = $_POST['isactive'];
    $userid = $_POST['userid'];
 
    $query = $con->prepare('CALL sp_updateUser(?,?,?,?,?,?,?,?,?)');
    $query->bind_param('siississi',$username,$email,$roles,$status,$isactive,$userid);
    
    if($query->execute()){
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}
?>