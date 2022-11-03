<?php

    session_start();
    ob_start();

	$db = new PDO("mysql:host = localhost;dbname=deneme;charset=utf8", "root", "");


// Güvenlik fonksiyonu
function Guvenlik($Deger){
    $BoslukSil		= trim($Deger); // kelime başındaki ve sonundaki boşlukları sil
    $TaglariTemizle	= strip_tags($BoslukSil); // kelimedeki html etiketlerini sil
    $EtkisizYap		= htmlspecialchars($TaglariTemizle, ENT_QUOTES); // özel karakterleri etkisiz hale getir
    $Sonuc			= $EtkisizYap;
    return $Sonuc;
}

?>