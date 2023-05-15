const {createApp} = Vue;

createApp({
    data(){
        return{
            userDetails:[],
            email:'',
            fetchData:[],
        }
    },
    methods:{
        fnLogIn:function(e){
            const vm = this;
            let form = e.currentTarget;
            const data = new FormData(form)
            data.append('method','fnLogIn')
            axios.post('dbCon/router.php',data)
            .then(function(respond){
                console.log(respond.data)
                if(respond.data === 1){
                    Swal.fire(
                        'Success!',
                        '',
                        'success',
                        
                    ).then(result=>{
                        window.location.href ="index.php"
                    })
                    setTimeout(function(){
                        location.replace('index.php');
                    }, 2500);
                }else{
                    Swal.fire(
                        'Error!',
                        'Wrong email and password.',
                        'error'
                    )
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
            const data = new FormData;
            data.append('method','fnGetUser')
            data.append('userid',id)
            axios.post('dbCon/router.php',data).then(respond=>{
                console.log(respond.data)
                
            })

        }
    },
    created:function(){
        this.fnGetUser(0);
    }


}).mount('#app-form')

