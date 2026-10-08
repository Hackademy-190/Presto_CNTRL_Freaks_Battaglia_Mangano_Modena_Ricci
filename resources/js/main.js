const navbar = document.querySelector('.navbar-cus');

window.onscroll = () => {
    if(window.scrollY > 0){
        navbar.classList.add('scrollNav');
    }else{
        navbar.classList.remove('scrollNav');
    }
}