const{createApp} = Vue;
createApp({
    data(){
        return{
            userInformation: [],
            userid: 0,
            username: '',
            firstname: '',
            lastname: '',
            street: '',
            city: '',
            state: '',
            zipcode: '',
            age: '',
            gender: '',
            email: '',
            password: '',
            images: ''  
        }
    },
    methods:{
        updateUserInformation:function(e) {
            const vm = this;
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to update this information!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Update'

            }).then((result) => {
                if (result.isConfirmed) {
                    data.append('method','updateUserInformation');
                    axios.post('model/userModel.php',data)
                    .then(function(r){
                        console.log(r);
                        if(r.data == 1) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: '<h6>Your personal information has been updated</h6>',
                                showConfirmButton: true
        
                            }).then((result) =>{
                                window.location.href = "./settings.php";
                            })
        
                        } else if(r.data == 2) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'There was an error updating your information!'
                            })
                        }
                    })
                }
            })
        },
        updateUserEmail:function(e) {
            const vm = this;
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to update this information!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Update'

            }).then((result) => {
                if (result.isConfirmed) {
                    data.append('method','updateUserEmail');
                    axios.post('model/userModel.php',data)
                    .then(function(r){
                        console.log(r);
                        if(r.data == 1) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: '<h6>Your email address has been updated</h6>',
                                showConfirmButton: true

                            }).then((result) =>{
                                window.location.href = "./resetEmail.php";
                            })

                        } else if(r.data == 2) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Account does"nt exist, Please try!'
                            })

                        } else if(r.data == 3) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'The email you provided is already taken, Please try again!'
                            })

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'There was an error updating your email address!'
                            })
                        }
                    })
                }
            })
        },
        updateUserPassword:function(e) {
            const vm = this;
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to update this information!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Update'

            }).then((result) => {
                if (result.isConfirmed) {
                    data.append('method','updateUserPassword');
                    axios.post('model/userModel.php',data)
                    .then(function(r){
                        console.log(r);
                        if(r.data == 1) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: '<h6>Your password has been updated</h6>',
                                showConfirmButton: true

                            }).then((result) =>{
                                window.location.href = "./resetPassword.php";
                            })

                        } else if(r.data == 2) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'The password you entered that does not match!'
                            })

                        } else if(r.data == 3) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Account does"nt exist, Please try again!'
                            })

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'There was an error updating your password!'
                            })
                        }
                    })
                }
            })
        },
        fnGetDetails:function(userid){
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
                        })
                    })
                }
                else{
                    f.data.forEach(function(e){
                        })
                    }
            })
        }
    },
    created:function(){

    }
}).mount('#profile-app')