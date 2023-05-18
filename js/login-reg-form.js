const {createApp} = Vue;

createApp({
    data(){
        return{
            userDetails:[],
            email:'',
            usersEmail:[],
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
                // console.log(respond.data)
                if(respond.data.ret == 0){
                    swal.fire(
                        'Error!',
                        'Credentials does not match',
                        'error'
                    )
                }else if(respond.data.isactive != 1){
                    swal.fire(
                        'Error!',
                        'Your account is Disabled ',
                        'error'
                    )
                }else{
                    swal.fire(
                        'Success',
                        '',
                        'success'
                    ).then(result =>{
                        if(respond.data.role== 1){
                            window.location.href = 'index.php'
                        }else{
                            window.location.href = 'dashboard.php'
                        }
                    })
                }
            })
        },
        fnRegister:function(e){
            console.log(this.usersEmail.includes(this.email))
            if(this.usersEmail.includes(this.email)){
                swal.fire({
                    icon:'warning',
                    title:'Email already exist',
                    text:'Please input another email'
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
                respond.data.forEach(user => {
                    vm.usersEmail.push(user.email)
                });
            })
        }
    },
    created:function(){
        this.fnGetUser();
    }
}).mount('#app-form')

