const {createApp} = Vue;

createApp({
    data(){
        return{
            userDetails:[],
            email:'',
            usersEmail:[],
            pass1:'',
            pass2:'',
        }
    },
    methods:{
        fnLogIn:function(e){
            const vm = this;
            let form = e.currentTarget;
            const data = new FormData(form)
            data.append('method','fnLogIn')
            axios.post('dbCon/router.php',data)
            .then(respond=>{
                console.log(respond.data)
                if(respond.data.ret == 0){
                    swal.fire(
                        'Error!',
                        'Credentials does not match',
                        'error'
                    )
                }else if(respond.data.ret == 1){
                    swal.fire(
                        'Login Success!',
                        'Logged in successfully',
                        'success'
                    ).then(result =>{
                        if(respond.data.user_role == 2){
                            window.location.href = 'dashboard.php'
                        }else{
                            window.location.href = 'index.php'
                        }
                       
                    })
                }else if(respond.data.ret == 2){
                    swal.fire(
                        'Error!',
                        'Wrong password',
                        'error'
                    )
                }else if(respond.data.ret == 3){
                    swal.fire(
                        'Account is locked',
                        'Please contact the administrator',
                        'warning'
                    )
                }
    
            })
        },
        fnRegister:function(e){
            if(this.usersEmail.includes(this.email)){
                swal.fire({
                    icon:'warning',
                    title:'Email already exist',
                    text:'Please input another email'
                })
            }else if(this.pass1!= this.pass2){
                swal.fire({
                    icon:'warning',
                    title:'Password does not match',
                    text:'Please input the same password'
                })
            }else{
                const data = new FormData(e.currentTarget)
                data.append('method','fnRegister')
                data.append('userid',0)
                axios.post('dbCon/router.php',data).then(respond=>{
                    console.log(respond.data)
                    if(respond.data == 1)
                    {
                        Swal.fire(
                            'Success!',
                            'User has been Created.',
                            'success'
                        ).then(result =>{
                            window.location.href = 'login.php'
                        })

                    }
                })
            }

        },
        fnGetUser:function(){
            const vm = this;
            const data = new FormData;
            data.append('method','fnGetUser')
            axios.post('dbCon/router.php',data).then(respond=>{
                if(respond.data.length > 0){
                    respond.data.forEach(user => {
                        vm.usersEmail.push(user.email)
                    });
                }
            })
        }
    },
    created:function(){
        this.fnGetUser();
    }
}).mount('#app-form')

