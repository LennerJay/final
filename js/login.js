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
                console.log(respond.data.length)
                if(respond.data === 1){
                    localStorage.setItem('isLoggedIn','200')
                    window.location.href = 'index.php'
                }else{
                    alert('incorrect credential')
                }
            })
        }
    }


}).mount('#app')