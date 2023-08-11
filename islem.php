<?php

session_start();
include 'fonksiyon/helper.php'; //get, post ve session fonksiyonlarının kullanımı daha derli toplu olsun diye fonksiyon dizininin altında helper.php de tüm fonksiyonları tanımladık ve yönetimlerini tek bir yerden yapacağız. aynı fonksiyonları islem ve login kısımlarında kullanabilmek için oralara da dahil ettik

$user=[
    'recepozdes'=>[
        'adi'=>'Recep ÖZDEŞ',
        'eposta'=>'recepozdes@sfasf.com',
        'dogum_tarihi'=>'1990',
        'yer'=>'Ankara',
        'password'=>'1234',
    ],
    'esraozdes'=>[
        'adi'=>'Esra ÖZDEŞ',
        'eposta'=>'esraozdes@sfasf.com',
        'dogum_tarihi'=>'1993',
        'yer'=>'Ankara',
        'password'=>'1234',
    ]
]; // uygulamamızın herhangi bir db bağlantısı olmadığı için localde kullanıcı bilgilerini tuttuk


if(get('islem')=='giris'){

    $_SESSION['username']=post('username');
    $_SESSION['password']=post('password');

    if(!post('username') || !post('password')){
        $_SESSION['error']='Lütfen kullanıcı adınızı/şifrenizi giriniz';
        header('Location:login.php');
    }else{
        if(array_key_exists(post('username') , $user)){
            if($user[post('username')]['password']==post('password')){

                $_SESSION['login']=true;
                $_SESSION['kullanici_adi']=$user[post('username')]['adi'];
                $_SESSION['eposta']=$user[post('username')]['eposta'];
                $_SESSION['dogum_tarihi']=$user[post('username')]['dogum_tarihi'];
                $_SESSION['yer']=$user[post('username')]['yer'];

                header('Location:index.php');


            }else{
            $_SESSION['error']='Kullanıcı bilgileri hatalı';
            header('Location:login.php');
            exit();
        }
        }else{
            $_SESSION['error']='Kayıtlı Kullanıcı Bulunamadı';
            header('Location:login.php');
            exit();
        }
    }
}  // login sayfasındaki kullanıcı adı ve şifre bilgilerinin doldurulup dolduruşmadığını kontrol eder


if(get('islem')=='hakkimda'){

    $hakkimda= post('hakkimda');
    $sonuc=file_put_contents('./db/'.session('username').'.txt',htmlspecialchars($hakkimda));

    if($sonuc){
        header('Location:index.php?islem=true');
    }else{
        header('Location:index.php?islem=false');
    }
    
}// index.php içerisinde bulunan text area kısmına yazılacak verilerin bir yerde tutulması ve kaydetme işlemlerinin yapılması için oluşturulmuştur. file_put_contents ile kayıt dosyası varsa içine yazat yoksa oluşturur ve yazar


if(get('islem')=='cikis'){

    session_destroy();
    session_start();
    $_SESSION['error']='Oturum sonlandırıldı';
    header('Location:login.php');

}//cıkış işlemleri yapılıyor


if(get('islem')=='renk'){

    get('color');
    setcookie('color',get('color'),time()+(86400*360));

    header('Location:'.$_SERVER['HTTP_REFERER']??'index.php');

}//background color seçim işlmeleri vesetcookie ile bu durumun kullanıcı özelinde hatırlanılması

