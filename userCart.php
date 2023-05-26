<?php 
    require("./dbCon/backend.php");
    session_start(); 
    // echo json_encode($_SESSION);exit;
?>

<!DOCTYPE html>

<html lang="en-PH">
    <head>
        <meta charset="UTF-8">
        <title>E-Commerce | User Cart</title>

        <meta name="author" content="Group Tactical Minds">
        <meta name="description" content="E-Commerce User User Cart">
        <meta name="keywords" content="E-Commerce, User Profile, Settings">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="Styles/userCartStyle.css">
        <link rel="icon" type="image/x-icon" href="Icons/ecommercelogo.ico">
        <link rel="stylesheet" href="Font-awesome/css/all.min.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>

    <div id="profile-app">
        <div class="sidebar">
            <div class="menu">
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <div class="profile">
                <!-- <img src="images/AdminLogo2.png" alt="User Profile" id="profile-img"> -->
                <span id="username">User</span>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="index.php">
                    <i class="fa-solid fa-cart-shopping user"></i>
                        <span class="nav-item">Shopping</span>
                    </a>
                    <span class="tool-tip">Shopping</span>
                </li>
                <li>
                    <a href="settings.php">
                        <i class="fa-solid fa-user user"></i>
                        <span class="nav-item">User</span>
                    </a>
                    <span class="tool-tip">User</span>
                </li>
                <li>
                    <a href="userCart.php">
                        <i class='bx bxs-cart'></i>
                        <span class="nav-item">shopping Cart</span>
                    </a>
                    <span class="tool-tip">shopping Cart</span>
                </li>
                <li>
                    <a href="user_purchased.php">
                        <i class='bx bxs-purchase-tag' ></i>
                        <span class="nav-item">my purchase</span>
                    </a>
                    <span class="tool-tip">my purchase</span>
                </li>
                <li>
                    <a href="resetEmail.php">
                    <i class="fa-solid fa-envelope reset-email"></i>
                        <span class="nav-item">Reset email</span>
                    </a>
                    <span class="tool-tip">Reset email</span>
                </li>
                <li>
                    <a href="resetPassword.php">
                    <i class="fa-solid fa-key reset-password"></i>
                        <span class="nav-item">Reset password</span>
                    </a>
                    <span class="tool-tip">Reset password</span>
                </li>
                <li>
                    <a href="logout.php">
                    <i class="fa-solid fa-right-from-bracket logout"></i>
                        <span class="nav-item">Logout</span>
                    </a>
                    <span class="tool-tip">Logout</span>
                </li>
            </ul>
        </div>
        <!-- End of class sidebar -->

        <div class="main-container">
            <div class="main-heading">
                <h1>Added to Cart</h1>
            </div>
            <div class="settings-wrapper">
                <section id="main-section"> 
                    <div v-if="cartContainer > 0">
                        <!-- if not empty  -->
                        <div class="section-content" v-for="product in product_data">
                            <div class="product-details"> 
                                <div class="products">
                                    <img :src="'images/'+ product.product_category +'/' + product.product_img" :alt="product.product_img" width="90" height="100">
                                    <div class="prod-infos">
                                        <p class="price">Product category: {{product.product_category}}</p>
                                        <p class="brand">Product brand: {{product.product_brand}} </p>
                                        <p class="name">Product name: {{product.product_name}}</p>
                                        <p class="price">Product price: {{product.product_oldPrice}}</p>
                                        <p class="price">Product description: {{product.product_description}}</p>
                                        <p class="price">Product specification: {{product.product_specification}}</p>
                                        <div class="buttons">
                                            <button type="button" id="remove" v-on:click="removeProduct(product.cart_id)">Remove</button>
                                            <button type="button" id="purchase" v-on:click="purchaseProduct(product.cart_id)">Purchase</button>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        <hr>
                        </div> 
                    </div>


                    <!-- if empty  -->
                    <div v-if="cartContainer < 1">
                        <div class="section-content" >
                        <div class="product-details">
                            <div class="products"> 
                                <div class="prod-infos">
                                    <h1>No Data Available Found</h1>
                                </div>
                            </div> 
                            <!-- End of products -->
                        </div>
                        <!-- End or product details -->
                    </div>
                    <!-- End of section content -->
                    </div>  
                </section>
                <!-- End of main section -->
            </div>
        </div>
    </div>
        <!-- End of profile app -->

        <script src="Server-side/Javascript/vue.v3.js"></script>
        <script src="Server-side/Javascript/axios.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        
        <script>
            let sidebar = document.querySelector('.sidebar');
            let btn = document.querySelector('#btn');

            btn.addEventListener("click", function(){
                sidebar.classList.toggle('active');
            });

            const{createApp} = Vue;
            createApp({
                data(){
                    return{
                        product_data: [], 
                        cartContainer: 0
                    }
                },
                methods:{
                    fetchCart:function() {
                        const vm = this; 
                        const data = new FormData();
                        data.append('method','fetchCart'); 

                        axios.post('model/userModel.php',data)
                        .then(function(r){ 
                            if(r.data.length > 0){ 
                                vm.cartContainer = 1;
                                r.data.forEach(e=>{
                                    vm.product_data.push({
                                        cart_id: e.cart_id,
                                        product_name: e.product_name,
                                        product_brand: e.product_brand,
                                        product_oldPrice: e.product_oldPrice,
                                        product_description: e.product_description,
                                        product_specification: e.product_specification,
                                        product_img: e.product_img,
                                        product_category: e.product_category
                                    })
                                })
                            } 
                        })
                    }, 
                    purchaseProduct: function(cartid){
                        const vm = this; 
                        const data = new FormData();
                        data.append('method','purchaseProduct'); 
                        data.append('cart_id', cartid);
                        axios.post('model/userModel.php',data)
                        .then(function(r){
                            console.log(r.data); 
                        }) 
                    }, 
                    removeProduct: function(cartid) {
                        const vm = this; 
                        const data = new FormData();
                        data.append('method','removeProduct');
                        data.append('cart_id',cartid);
                        axios.post('model/userModel.php',data)
                        .then(function(r){
                            console.log(r.data); 
                        }) 
                    },

                },
                created:function(){
                    this.fetchCart();
                }
            }).mount('#main-section')
        </script>

    </body>
</html>