let sidebar = document.querySelector('.sidebar');
let btn = document.querySelector('#btn');

btn.addEventListener("click", function(){
    sidebar.classList.toggle('active');
});