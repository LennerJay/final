const {createApp} = Vue;

createApp({
    data(){
        return{
            userDetails:[]
 
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
        // test:function(){
        //     console.log('test')
        // }
    },
    // created:function(){
    //     this.test()
    // }


}).mount('#app-form')

