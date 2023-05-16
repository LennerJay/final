const {createApp} = Vue;

createApp({
    data(){
        return{
            userDetails:[],
            email:'',
            usersData:[],
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
                else
                {
                    Swal.fire(
                        'Error!',
                        'Email already been used.',
                        'error'
                    )
                }
            })
        },
        fnGetUser:function(id){
            const vm = this;
            const data = new FormData;
            data.append('method','fnGetUser')
            data.append('userid',id)
            axios.post('dbCon/router.php',data).then(respond=>{
                // console.log(respond.data)
                // respond.data.forEach(user => {
                    
                // });
                // vm.usersData.push(respond.data);
            })
        }
    },
    mounted:function(){
        // console.log(this.usersData)
        // console.log(Object.keys(this.usersData))
    },
    created:function(){
        this.fnGetUser(0);
    }


}).mount('#app-form')

