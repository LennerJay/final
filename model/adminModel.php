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

    // echo json_encode([$_POST['variant'],$_POST['variant_stock'],$_FILES['variant_image']['name']]);
    echo json_encode([$_POST['variants']]);
    // $product_name = $_POST['product_name'];
    // $product_price = $_POST['price'];
    // $product_newPrice = $_POST['new_price'];
    // $product_brand = $_POST['brand'];
    // $product_stock = $_POST['vstock'];
    // $product_spec = $_POST['product_spec'];
    // $product_description = $_POST['product_description'];
    // $product_category = $_POST['product_category'];
    // $files = $_FILES['product_picture']['name'];
    // $folder = "../images/" . $product_category . '/';
    // $destination = $folder . $files;
    // $product_id = $_POST['product_id'];
    // $query = $con->prepare('CALL sp_addUpdateProduct(?,?,?,?,?,?,?,?,?,?)');
    // $query->bind_param('ssssiiissi',$product_brand,$product_name,$product_description,$product_spec,$product_price,$product_newPrice,$product_stock,$product_category,$files,$product_id);
    // if($query->execute()){
    //     move_uploaded_file($_FILES['product_picture']['tmp_name'],$destination);
    //     addVariantUpdateProduct();
    //     // echo 1;
    // }
    // else{
    //     echo json_encode(mysqli_error($con));
    // }

}
function addVariantUpdateProduct(){
    global $con;

    $product_name = $_POST['product_name'];
    $product_price = $_POST['price'];
    $product_newPrice = $_POST['new_price'];
    $product_brand = $_POST['brand'];
    $product_stock = $_POST['vstock'];
    $product_spec = $_POST['product_spec'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];
    $files = $_FILES['product_picture']['name'];
    $folder = "../images/" . $product_category . '/';
    $destination = $folder . $files;
    $product_id = $_POST['product_id'];
    $query = $con->prepare('CALL sp_addUpdateProduct(?,?,?,?,?,?,?,?,?,?)');
    $query->bind_param('ssssiiissi',$product_brand,$product_name,$product_description,$product_spec,$product_price,$product_newPrice,$product_stock,$product_category,$files,$product_id);

    
}
function fnAddVariant(){
    global $con;
    // echo $_POST['variant']." ".$_POST['var_stock']." ".$_POST['product_img']." ".$_POST['product_id'];
    $variant = $_POST['product_variant'];
    $var_stock = $_POST['var_stock'];
    $img = $_POST['product_img'];
    $product_id = $_POST['product_id'];
    $query = $con->prepare('CALL sp_addVariant(?,?,?,?)');
    $query->bind_param('isis',$product_id,$variant,$var_stock,$img);

    if($query->execute()){
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
    $userid = $_POST['userid'];
 
    $query = $con->prepare('CALL sp_updateUser(?,?,?,?,?,?,?,?,?,?,?,?)');
    $query->bind_param('sssssssisiii',$username,$email,$firstname,$lastname,$street,$city,$state,$zipcode,$gender,$roles,$status,$userid);
    
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
    $userid = $_POST['userid'];

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
    $pid = $_POST['pdi'];
    $quantity = $_POST['pQuantity'];
    $price = $_POST['pOldPrice'];
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
function fnGetTotalSales(){
    global $con;

    $query = $con->prepare('CALL sp_getTotalSales(0)');

    $query->execute();
    $result = $query->get_result();
    $data = array();
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
    echo json_encode($data);
}
function fnGetDisableUser(){
    global $con;
    $id = $_POST['id'];

    $query = $con->prepare('CALL sp_getDisableUser(?)');
    $query->bind_param('i',$id);

    $query->execute();
    $result = $query->get_result();
    $data = array();
    while($row = $result->fetch_array()){
        $data[] = $row;
    }

    echo json_encode($data);
}
function fnUpdateBlockUser(){
    global $con;
    $id = $_POST['id'];

    $query = $con->prepare('CALL sp_updateBlockUser(?)');
    $query->bind_param('i',$id);

    if($query->execute()){
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}
function fnDeleteBlockUser(){
    global $con;
    $id = $_POST['id'];

    $query = $con->prepare('CALL sp_deleteBlockUser(?)');
    $query->bind_param('i',$id);

    if($query->execute()){
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}
?>