let sidebar = document.querySelector('.sidebar');
let btn = document.querySelector('#btn');

btn.addEventListener("click", function(){
	sidebar.classList.toggle('active');
});

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
	mounted:function(){
    },
    created:function(){
    }
}).mount('#profile-app')