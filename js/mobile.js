function nav_show(){
    var nav= document.querySelector("#nav"); 
    if (nav.style.display=="block"){
        nav.style.display="none";}
    else {
        nav.style.display="block";
    }
}
if((document.body.clientWidth < 1000) && (getCookie('user'))){
            var user = document.querySelector('#user');
            var nav = document.querySelector('#nav');
            user.remove();
            nav.appendChild(user);
}