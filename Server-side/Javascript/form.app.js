const{createApp} = Vue;

createApp({
    data(){
        return{
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
        fnRegister:function(e){
            const vm = this;
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);
            data.append('method','fnRegister');
            data.append('userid',this.userid);
            axios.post('model/userModel.php',data)
            .then(function(r){
                console.log(r);
                if(r.data == 1)
                {
                    Swal.fire(
                        'Success!',
                        'User has been Created.',
                        'success'
                    )
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
        fnLogin:function(e){
            const vm = this;
            e.preventDefault();
            var form = e.currentTarget;
            const data = new FormData(form);
            data.append('method','fnLogin');
            data.append('userid',this.userid);
            axios.post('model/userModel.php',data)
            .then(function(r){
                
                if(r.data == 1)
                {
                    Swal.fire(
                        'Success!',
                        'Wrong email and password.',
                        'success'
                    );
                    setTimeout(function(){
                    location.replace('index.php');
                }, 2500);
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        'Wrong email and password.',
                        'error'
                    )
                }
            })
        }
    }
}).mount('#app-form')