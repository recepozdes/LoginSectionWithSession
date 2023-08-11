<?php
// get session post gibi işlemleri fonksiyonlara bağladık ve tek bir yerden kontrol etmek için burada topladık. fonksiyonlar içinde get post ve sessionlar varsa (isset) bu değerleri trim yaparak whitespacelerden arındırdık ve geri döndürdük yoksa hata yolladık
function get($get){
    if (isset($_GET[$get])){
        return trim($_GET[$get]);
    }else{
        return false;
    }
}

function post($post){
    if (isset($_POST[$post])){
        return trim($_POST[$post]);
    }else{
        return false;
    }
}

function session($session){
    if (isset($_SESSION[$session])){
        return trim($_SESSION[$session]);
    }else{
        return false;
    }
}

function cookie($cookie){
    if (isset($_COOKIE[$cookie])){
        return trim($_COOKIE[$cookie]);
    }else{
        return false;
    }
}

?>