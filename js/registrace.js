function checkInputs(Object){
    if (Object.value=='')  {
        Object.style.border='thick solid red';
        Object.nextSibling.innerHTML='Toto pole je povinné';
        return false;            
    }
    else {
        Object.style.border='';
        Object.nextSibling.innerHTML='';
        return true;
    }
}
function correctPassword(Object){
    checkInputs(Object);
    var heslo = document.getElementById('password');
    var delka=heslo.value.length;
    if(delka<8){
        heslo.style.border='thick solid red';
        Object.nextSibling.innerHTML='heslo je krátké';    
    }
    else { 
        heslo.style.border='thick solid green';
        Object.nextSibling.innerHTML='';
    }
}
function checkPassword(Object){
    checkInputs(Object);
    if(checkInputs(Object)){
        var heslo = document.getElementById('password');
        var hesloAgain = document.getElementById('passwordAgain');
        if(heslo.value!=hesloAgain.value){
            hesloAgain.style.border='thick solid red';
            document.getElementsByClassName('alert')[5].innerHTML='hesla nejsou shodná';
        }
        else {
            hesloAgain.style.border='thick solid green';
            Object.nextSibling.innerHTML='';
        }
    }
}
function Odeslani(){
    var name = escape(self.document.forms.f.name.value);
    var vorname = escape(self.document.forms.f.vorname.value);
    var password = escape(self.document.forms.f.password.value);
    var passwordAgain = escape(self.document.forms.f.passwordAgain.value);
    var delka = escape(self.document.forms.f.password.value.length);
    if ((name!="")&&(vorname!="")&&(password!="")&&(passwordAgain!="")&&(password==passwordAgain)&&(delka>6)&&(checkFile())){
        return true;
    }
    else {
        return false;
    }
}
function checkFile(Object){
    var input, file;
    input = document.getElementById('file');
    file = input.files[0];
    if(file.size >= (2*1024*1024)){
        input.style.border='thick solid red';
        input.nextSibling.innerHTML='Obrázek je příliš velký- '+(file.size/1024)+'kB';
        return false;
    }
    else {
        Object.nextSibling.innerHTML= (file.size/1024)+'kB';
        return true;
        
    }
}