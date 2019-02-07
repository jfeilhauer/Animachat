// main javascript
var symbols = [":)",":D",";)",";*",";P",":(",":*(",":o","<3"];
var emoji = ["🙂","😄","😉","😘","😜","😞","😢","😯","❤"];
var emojiList= ["🙂","😀","😄","😆","😅","😂","😊","😉","😏","😍","😘","🤗","😳","😇","😜","😋","😎","😒","😞","😖","😢","😭","😟","🤔","😴","😯","😬","👍","👎","✌️","👌","☝️","👊","✊","💪","🙏","✋","👋","♥️","❤","💕","💓"];
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function arrayCompare(array1,array2) {
    if ((!array1)&&(!array2)) {
        return false;
    }
    if (array2.length !== array1.length) {
        return false;
    }
    for (var i = 0, l = array2.length; i < l; i++) {
        if (array2[i] instanceof Array && array1[i] instanceof Array) {
        if (!array2[i].compare(array1[i])) {
            return false;
        }
        }
        else if (array2[i] !== array1[i]) {
        return false;
        }
    }
    return true;
}
function replaceSmiles(string){ 
    for(var i=0;i<symbols.length;i++){
        string= string.replace(symbols[i],emoji[i]);
    }
    return string;    
}
function passwordShow(object) {
    var x = object;
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

