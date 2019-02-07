// globální proměnné
var user2 =0;
var click=1;
var id = '';
var pocet = 1;
var zpravy = '';
// hlavní funkce
window.addEventListener('load', LoadMess);
document.querySelector('#loadNext').addEventListener('click', LoadNext);
document.querySelector('#message').addEventListener('keydown', KeyDownMess);
window.addEventListener('click', function(e){hide(e);});
// funkce
function ajaxUpload(text){
    text = encodeURIComponent(text);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            ajaxDownload((getCookie('user')), user2, 1);
          
        }
    };
    xhttp.open("POST", "models/ajaxUpload.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("zprava="+text+"&user="+getCookie('user')+"&user_to="+user2);
} 
function ajaxDownload(user1,user2, typ){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // 1-scroll down, 2- noscroll, 3-halfscroll
            if(typ==1){
                vytvorZpravy(this.responseText,1);
            }
            else if(typ==2){
                vytvorZpravy(this.responseText,2);
            }
            else if(typ==3){
                vytvorZpravy(this.responseText,3);
            } 
        }
    };
    xhttp.open("POST", "models/ajaxDownload.php", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("user1="+user1+"&user2="+user2+"&pocet="+pocet);
}
function vytvorZpravy(ex,typ)
{ 
    var x = ex.split("|");
    var table="";
    for (var i = 1; i < x.length; i++) { 
        // user
        if(i%4==1){
            table = table + '<div class="zprava"><img src="../img/avatars/a'+x[i]+'.png"/>';
        }
        // message
        else if (i%4==3){
            table = table +'<div class="messages" onclick="showDate('+((i-3)/4)+')">'+ x[i]+"</div>";
        }
        else if(i%4==0){
            x[i]=x[i].slice(-8,-3);
            table = table +'<div class="dates">'+ x[i]+"</div></div>";
        }
    }
    if (!arrayCompare(zpravy,x)){
        vypisMessage(table,typ);
        zpravy=x;
    }
   
}  
function vypisMessage(message,typ)
{   
    document.getElementById('messengerPlace').innerHTML= message+'\n';
    if(typ==1){
        scroll_Down(50000);
        document.getElementById('message').value='';
    }
    else if(typ==2){
        document.getElementById('message').value='';
    }
    else if(typ==3){
        scroll_Down((document.getElementById('messenger').scrollHeight/pocet)-21);
        document.getElementById('message').value='';
    }
    else {
        document.write('error');
    } 
}

function selectUser(id)
{
    var users= document.getElementsByClassName('users');
    for(var i = 0; i<users.length; i++){
        if(i!=id){
            users[i].style.backgroundColor= 'transparent';
            users[i].style.color= 'black';
        }
        else {
            users[i].style.backgroundColor= '#123368';
            users[i].style.color= 'white';
        }
    }
    user2 = id;
    pocet = 1;
    ajaxDownload((getCookie('user')),id,1);                
}
function showDate(id2){
    var dates= document.getElementsByClassName('dates');
    for(var i=0; i < dates.length;i++){
        if(i==id2){
        dates[id2].classList.toggle('visibling')
        }
        else{
        dates[i].classList.remove('visibling');
        }
    }
}
function KeyDownMess(e){
    var message = document.querySelector('#message');
    if ((e.keyCode=='13') && (message.value!='')){
        message.value = replaceSmiles(message.value);
        ajaxUpload(message.value);
    }
    else if(e.keyCode=='32'){
        message.value = replaceSmiles(message.value);
    }
}
function LoadNext(e){
    pocet++;
    ajaxDownload((getCookie('user')), user2, 3);
}
function LoadMess(){
    ajaxDownload((getCookie('user')),user2,1);
    setInterval(function(){ 
        ajaxDownload((getCookie('user')),user2, 1);
    }, 10000);
}
function insertSmile(smile){
    document.querySelector('#message').value+=smile;
}
function hide(e){
    x=e.target;
    if((x.parentElement.id != 'eButton')&&(x.className != 'eTable')&&(x.parentElement.className != 'eTable')){ 
        var table= document.querySelector(".eTable"); 
            table.style.display="none";
    }  
}
function show(e){
    var table= document.querySelector(".eTable"); 
    if (table.style.display=="inline-block"){
        table.style.display="none";}
    else {
        table.style.display="inline-block";
    }
}
function scroll_Down(y){
    if(document.getElementById('messenger').scrollTo){
        // chrome, mozilla
        document.getElementById('messenger').scrollTo(0,y);
    }
    else{
        // edge, explorer
        document.getElementById('messenger').scrollTop=y;
    }
}