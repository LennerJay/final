const{createApp} = Vue;

createApp({
    data(){
        return{
            users: [],
            disuser: [],
            items: [],
            username: '',
            email: '',
            userid: 0,
            product_id: 0,
            product_name: '',
            product_price: '',
            product_newPrice: '',
            product_brand: '',
            product_variant: '',
            product_stock: '',
            product_description: '',
            product_spec: '',
            product_images: '',
            product_catergory: ''
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
                            isactive: e.isactive,
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
                            vm. city = e.city,
                            vm.state = e.state,
                            vm.zipcode = e.zipcode,
                            vm.gender = e.gender,
                            vm.date_created = e.date_created,
                            vm.role = e.role,
                            vm.status = e.status,
                            vm.isactive = e.isactive,
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
        },
        fnGetDisableUser:function(){
            const vm = this;
            const data = new FormData();
            data.append('method','fnGetUser')
            axios.post('model/adminModel.php',data)
            .then(function(f){
                vm.disuser = [];
                f.data.forEach(function(e){
                    vm.disuser.push({
                        username: e.username,
                        email: e.email,
                        date_created: e.date_created,
                        isactive: e.isactive,
                        date_disabled: e.date_disabled
                    })
                })
            })
        },
        fnAddProduct:function(e){
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);
            data.append('method','fnAddProduct');
            data.append('product_id',this.product_id);
            axios.post('model/adminModel.php',data)
            .then(function(r){
                // console.log(r);
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
        }
    },
    mounted:function(){
    },
    created:function(){
        this.fnGetItems(0);
        this.fnGetUser(0);
    }
}).mount('#dashboard-app')