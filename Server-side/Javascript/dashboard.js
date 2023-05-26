const{createApp} = Vue;

createApp({
    data(){
        return{
            users: [],
            customers: [],
            items: [],
            purchasedItems: [],
            disuser: [],
            totalSales: '',
            username: '',
            email: '',
            firstname: '',
            lastname: '',
            street: '',
            city: '',
            state: '',
            zipcode: '',
            gender: '',
            date_created: '',
            role: '',
            status: '',
            userid: 0,
            product_id: 0,
            product_name: '',
            product_price: '',
            product_newPrice: '',
            product_brand: '',
            product_variant: '',
            product_stock: '',
            product_description: '',
            product_specification: '',
            product_images: '',
            product_category: ''
        }
    },
    methods:{
        fnGetUser:function(userid){
            const vm = this;
            const data = new FormData();
            data.append("method","fnGetUser");
            data.append("userid",userid);
            axios.post('model/adminModel.php',data)
            .then(function(f){
                if(userid == 0){
                    vm.users = [];
                    f.data.forEach(function(e){
                        vm.users.push({
                            username: e.username,
                            email: e.email,
                            firstname: e.firstname,
                            lastname: e.lastname,
                            street: e.street,
                            city: e.city,
                            state: e.state,
                            zipcode: e.zipcode,
                            gender: e.gender,
                            date_created: e.date_created,
                            role: e.role,
                            status: e.status,
                            userid: e.userid
                        })
                    })
                }
                else{                
                    f.data.forEach(function(e){
                            vm.username = e.username,
                            vm.email = e.email,
                            vm.firstname = e.firstname,
                            vm.lastname = e.lastname,
                            vm.street = e.street,
                            vm.city = e.city,
                            vm.state = e.state,
                            vm.zipcode = e.zipcode,
                            vm.gender = e.gender,
                            vm.date_created = e.date_created,
                            vm.role = e.role,
                            vm.status = e.status,
                            vm.userid = e.userid;
                        })
                }
                setTimeout(function(){
                    if (!$.fn.DataTable.isDataTable('#myDataTable')) {
                      $('#myDataTable').dataTable();
                    }
                }, 100);
            })
        },
        fnUpdateUser:function(e){
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);
            data.append('method','fnUpdateUser');
            data.append('userid',this.userid);
            axios.post('model/adminModel.php',data)
            .then(function(r){
                if(r.data == 1)
                {
                    Swal.fire(
                        'Updated!',
                        'User has been updated.',
                        'success'
                    )
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        'There is an error upon updating.',
                        'error'
                    )
                }
                setTimeout(function(){
                    location.reload();
                }, 2000);
            })
        },
        fnGetCustomer:function(userid){
            const vm = this;
            const data = new FormData();
            data.append("method","fnGetCustomer");
            data.append("userid",userid);
            axios.post('model/adminModel.php',data)
            .then(function(f){
                if(userid == 0){
                    vm.customers = [];
                    f.data.forEach(function(e){
                        vm.customers.push({
                            fullname: e.Costumer_Name,
                            address: e.Address,
                            zipcode: e.zipcode,
                            gender: e.gender,
                            email: e.email,
                            status: e.status,
                            userid: e.userid
                        })
                    })
                }
                else{
                    f.data.forEach(function(e){
                            vm.fullname = e.Costumer_Name,
                            vm.address = e.Address,
                            vm.zipcode = e.zipcode,
                            vm.gender = e.gender,
                            vm.email = e.email,
                            vm.status = e.status,
                            vm.userid = e.userid
                        })
                }
                setTimeout(function(){
                    if (!$.fn.DataTable.isDataTable('#myDataTable')) {
                      $('#myDataTable').dataTable();
                    }
                }, 100);
            })
        },
        fnGetCustomerPurchased:function(userid){
            const vm = this;
            const data = new FormData();
            data.append("method","fnGetCustomerPurchased");
            data.append("userid",userid);
            axios.post('model/adminModel.php',data)
            .then(function(f){
                vm.purchasedItems = [];
                f.data.forEach(function(e){
                    vm.purchasedItems.push({
                        product_brand: e.product_brand,
                        product_name: e.product_name,
                        product_description: e.product_description,
                        product_variant: e.product_variant,
                        product_specification: e.product_specification,
                        quantity: e.quantity,
                        product_stock: e.product_stock,
                        product_oldPrice: e.product_oldPrice,
                        product_newPrice: e.product_newPrice,
                        product_category: e.product_category,
                        product_images: e.product_img,
                        product_id: e.product_id,
                        status: e.status,
                        userid: e.userid
                    })
                })
            })
        },
        fnUpdateSales:function(e)
        {
            this.purchasedItems.forEach(pItems => {
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);
            data.append('method','fnUpdateSales');
            data.append('userid',pItems.userid);
            data.append('pdi',pItems.product_id);
            data.append('pQuantity',pItems.quantity);
            data.append('pOldPrice',pItems.product_oldPrice);
            axios.post('model/adminModel.php',data)
            .then(function(r){
                console.log(r);
                if(r.data == 1)
                {
                    Swal.fire(
                        'Updated!',
                        'User has been updated.',
                        'success'
                    )
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        'There is an error upon updating.',
                        'error'
                    )
                }
                setTimeout(function(){
                    location.reload();
                }, 2000);
            })
            });
        },
        fnAddProduct:function(e){
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);
            data.append('method','fnAddProduct');
            data.append('product_id',this.product_id);
            axios.post('model/adminModel.php',data)
            .then(function(r){
                if(r.data == 1)
                {
                    Swal.fire(
                        'Added!',
                        'Product has been Added.',
                        'success'
                    )
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        'There is an error upon uploading.',
                        'error'
                    )
                }
                setTimeout(function(){
                    location.reload();
                }, 2000);
            })
        },
        fnAddVariant:function(e){
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);
            data.append('method','fnAddVariant');
            axios.post('model/adminModel.php',data)
            .then(function(r){
                console.log(r);
                if(r.data == 1)
                {
                    Swal.fire(
                        'Added!',
                        'Variant has been Added.',
                        'success'
                    )
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        'There is an error upon Adding.',
                        'error'
                    )
                }
                setTimeout(function(){
                    location.reload();
                }, 2000);
            })
        },
        fnGetItems:function(productid){
            const vm = this;
            const data = new FormData();
            data.append("method","fnGetItems");
            data.append("productid",productid);
            axios.post('model/adminModel.php',data)
            .then(function(f){
                if(productid == 0){
                    vm.items = [];
                    f.data.forEach(function(e){
                        vm.items.push({
                            product_brand: e.product_brand,
                            product_name: e.product_name,
                            product_description: e.product_description,
                            product_spec: e.product_specification,
                            product_price: e.product_oldPrice,
                            product_variant: e.product_variant,
                            product_newPrice: e.product_newPrice,
                            product_stock: e.product_stock,
                            product_sold: e.product_sold,
                            product_images: e.product_img,
                            product_category: e.product_category,
                            date_created: e.date_created,
                            product_id: e.product_id
                        })
                    })
                }
                else{
                    f.data.forEach(function(e){
                            vm.product_brand = e.product_brand,
                            vm.product_name = e.product_name,
                            vm.product_description = e.product_description,
                            vm.product_spec = e.product_specification,
                            vm.product_price = e.product_oldPrice,
                            vm.product_variant = e.product_variant,
                            vm.product_newPrice = e.product_newPrice,
                            vm.product_stock = e.product_stock,
                            vm.product_sold = e.product_sold,
                            vm.product_images = e.product_img,
                            vm.product_category = e.product_category,
                            vm.date_created = e.date_created,
                            vm.product_id = e.product_id
                        })
                    }
            })
        },
        fnGetTotalSales:function(){
            const vm = this;
            const data = new FormData();
            data.append('method','fnGetTotalSales');
            axios.post('model/adminModel.php',data)
            .then(response => {    
            //  console.log(response);   
                    response.data.forEach((d) => { 
                        vm.totalSales = d.total_sales
                    });   

            }).catch(error => {
                console.error(error);
            });
         },
        fnDeleteItem:function(productid){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                padding: 25,
                width: 500,
                height: 500
              }).then((result) => {
                if (result.isConfirmed) {
                    const data = new FormData();
                    data.append('method','fnDeleteItem');
                    data.append('productid',productid);
                    axios.post('model/adminModel.php',data)
                    .then(function(f){
                        if(f.data == 1)
                        {
                            Swal.fire(
                                'Deleted!',
                                'Your product has been deleted.',
                                'success'
                            )
                        }
                        else
                        {
                            Swal.fire(
                                'Error!',
                                'There is an error upon deleting.',
                                'error'
                            )
                        }
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    })
                }
            })
        },
        fnGetDisableUser:function(id){
            const vm = this;
            const data = new FormData();
            data.append('method','fnGetDisableUser');
            data.append('id',id);
            axios.post('model/adminModel.php',data)
            .then(function(f){
                if(id == 0){
                    vm.disuser = [];
                    f.data.forEach(function(e){
                        vm.disuser.push({
                            username: e.username,
                            email: e.email,
                            Fullname: e.Fullname,
                            address: e.Address,
                            email: e.email,
                            gender: e.gender,
                            attempt: e.attempt,
                            date_disable: e.date_disable,
                            userid: e.userid
                        })
                    })
                }
                else{
                    f.data.forEach(function(e){
                        vm.username = e.username,
                        vm.email = e.email,
                        vm.fullname = e.Fullname,
                        vm.address = e.Address,
                        vm.email = e.email,
                        vm.gender = e.gender,
                        vm.attempt = e.attempt,
                        vm.date_disable = e.date_disable,
                        vm.userid = e.userid
                    })
                }
            })
        },
        fnUpdateBlockUser:function(id){
            const data = new FormData();
            data.append('method','fnUpdateBlockUser');
            data.append('id',id);
            axios.post('model/adminModel.php',data)
            .then(function(r){
                if(r.data == 1)
                {
                    Swal.fire(
                        'Updated!',
                        'User has been Updated.',
                        'success'
                    )
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        'There is an error upon Updating.',
                        'error'
                    )
                }
                setTimeout(function(){
                    location.reload();
                }, 3000);
            })
        },
        fnDeleteBlockUser:function(id){
            const data = new FormData();
            data.append('method','fnDeleteBlockUser');
            data.append('id',id);
            axios.post('model/adminModel.php',data)
            .then(function(r){
                if(r.data == 1)
                {
                    Swal.fire(
                        'Deleted!',
                        'User has been Deleted.',
                        'success'
                    )
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        'There is an error upon Deleting.',
                        'error'
                    )
                }
                setTimeout(function(){
                    location.reload();
                }, 3000);
            })
        }
    },
    mounted:function(){
        this.fnGetTotalSales();
    },
    created:function(){
        this.fnGetItems(0);
        this.fnGetUser(0);
        this.fnGetCustomer(0);
        this.fnGetDisableUser(0);
    }
}).mount('#dashboard-app')