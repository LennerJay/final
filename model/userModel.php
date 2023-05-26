<?php
    include "../include/dbCon.php";
    include "../dbCon/database.php";
    
    session_start();

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

    function updateUserInformation() 
    {
        global $con;

        $userid = $_POST['userid'];
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];

        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipCode = $_POST['zip-code'];

        $stmt = $con->prepare("call sp_updateUserInformation(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if($stmt->execute(array($username, $firstname, $lastname, $street, $city, $state, $zipCode, $age, $userid))) {
            echo 1;
        }else {
            echo 2;
        }
        $con->close();

    }//End of updateUserInformation() function

    function updateUserEmail() 
    {
        $db = new Database(); 

        $userid = $_POST['userid'];
        $email = $_POST['email'];
        $newEmail = $_POST['new_email'];
        $password = $_POST['password'];
        $encPass = md5($password);

        //Trapping entered credentials by users
        $stmt = $db->getCon()->prepare("call sp_existChecker(?)");
        $stmt->execute(array($newEmail));
        $result = $stmt->fetch();

        if($result) {
            echo 3;

        } else {
            $stmt = $db->getCon()->prepare("call sp_accountChecker(?, ?)");
            $stmt->execute(array($email, $encPass));
            $result = $stmt->fetch();

            if($result) {  
                try{
                    if($db->getStatus()){
                        $stmt = $db->getCon()->prepare("call sp_updateUserEmail(?, ?)"); 
                        $stmt->execute(array($newEmail, $userid)); 
                    }
                    
                }
                catch(mysqli_sql_exception $e){
                    echo $e;
                }
                echo 1;

            } else {
                echo 2;
            }
        }
        $db->closeConnection();

    }//End of updateUseremail() function

    function updateUserPassword() 
    {
        $db = new Database(); 

        $userid = $_POST['userid'];
        $email = $_POST['email'];
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        $accountChecker = false;

        //Trapping entered emails by users
        try{
            if($db->getStatus()) {
                $stmt = $db->getCon()->prepare("call sp_accountChecker(?, ?)");
                $encOldPass = md5($oldPassword);
                $stmt->execute(array($email, $encOldPass));
                $result = $stmt->fetch();
                
                if($result) {
                    $accountChecker = true;
                }
            }
        } catch(mysqli_sql_exception $e) {
            echo $e;
        }

        //Trapping entered passwords by users
        if($accountChecker == true) {
            if($newPassword == $confirmPassword) {
                try{
                    if($db->getStatus()) {
                        $stmt = $db->getCon()->prepare("call sp_updateUserPassword(?, ?)"); 
                        $encNewPass = md5($newPassword);
                        $stmt->execute(array($encNewPass, $userid));
                        echo 1;
                    }
                } catch(mysqli_sql_exception $e) {
                    echo $e;
                }

            } else {
                echo 2;
            }

        } else {
            echo 3;
        }
        $db->closeConnection();

    }//Endof updateUserPassword() function

    function fetchCart(){
        $db = new Database(); 

        try{
            if($db->getStatus()) {
                $stmt = $db->getCon()->prepare("SELECT 
                    tbl_products.product_name,
                    tbl_products.product_brand,
                    tbl_products.product_oldPrice,
                    tbl_products.product_description,
                    tbl_products.product_specification,
                    tbl_products.product_img,  
                    tbl_products.product_category,
                    tbl_cart.cart_id

                    FROM tbl_cart
                    INNER JOIN tbl_products ON tbl_products.product_id=tbl_cart.product_id
                    WHERE tbl_cart.userid = ? AND tbl_cart.status = ?"); 

                $stmt->execute(array($_SESSION['user_id'], 0));
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                
                echo json_encode($result);
            }

            $db->closeConnection();  
        } catch(Exception $e) {
            echo $e;
        }

    }//End of fetchCart() function

    function purchaseProduct(){
        $db = new Database(); 

        try{ 
            if($db->getStatus()) {
                $id = $_POST['cart_id'];

                //fetch
                $stmt = $db->getCon()->prepare("call sp_getPurchasedProducts(?)"); 
                $stmt->execute(array($id));
                $result = $stmt->fetch();

                //delete
                $stmt = $db->getCon()->prepare("call sp_deleteProducts(?)"); 
                $stmt->execute(array($id));  
                
                //insert
                $stmt = $db->getCon()->prepare("call sp_saveProducts(?, ?, ?, ?)"); 
                $stmt->execute(array($result['userid'], $result['product_id'], 1, 'Pending'));

                echo 1;
            } 
            $db->closeConnection();  

        } catch(Exception $e) {
            echo $e;
            echo 2;
        }

    }//End of purchasedProduct() function

    function fetchUserPurchased() {
        $db = new Database(); 

        try{
            if($db->getStatus()) {
                $id = $_SESSION['user_id']; 

                $stmt = $db->getCon()->prepare("call sp_userPurchased(?)"); 
                $stmt->execute(array($id));
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                
                echo json_encode($result);
            }
            $db->closeConnection();  

        } catch(Exception $e) {
            echo $e;
        }

    }//End of fetchUserPurchased() function

    function removeProduct() {
        $db = new Database(); 

        try{
            if($db->getStatus()) {
                $id = $_SESSION['user_id']; 
                $cart_id = $_POST['cart_id'];

                $stmt = $db->getCon()->prepare("DELETE FROM tbl_cart WHERE userid = ? AND cart_id = ?");
                $stmt->execute(array($id, $cart_id));

                echo 1;
            }
            $db->closeConnection();  

        } catch(Exception $e) {
            echo $e;
        }

    }//End of removeProduct() function

?>