<?php

include_once("db.php");

// Veri Ekleme
if (isset($_POST["ekle"])) {

	$id 		= Guvenlik($_POST['id']);
	$parola 	= Guvenlik($_POST['parola']);
	$bakici 	= Guvenlik($_POST['bakici']);
	$fiyat 		= Guvenlik($_POST['fiyat']);

	$iletisim	= Guvenlik($_POST['iletisim']);
	$meslek 	= Guvenlik($_POST['meslek']);
	$sehir 		= Guvenlik($_POST['sehir']);
	$calisma 	= Guvenlik($_POST['calisma']);
	

	$_SESSION["id"] 		= $id;
	$_SESSION["parola"] 	= $parola;
	$_SESSION["bakici"] 	= $bakici;
	$_SESSION["fiyat"] 		= $fiyat;
	$_SESSION["iletisim"] 	= $iletisim;
	$_SESSION["meslek"] 	= $meslek;
	$_SESSION["sehir"] 		= $sehir;
	$_SESSION["calisma"] 	= $calisma;
	


	$veriSor = $db->prepare("SELECT id FROM bakicilar WHERE id = ?");
	$veriSor->execute(array($id));

	$veriCount = $veriSor->rowCount();

	if ($veriCount) {
		/*$_SESSION['message'] = "Bu id alınmış";*/
		header("Location: index.php");
		exit();
	}else {

		if ($id != "" and $parola != "" and $bakici != "" and $fiyat != "" and $iletisim != "" and $meslek != "" and $sehir != "" and $calisma != "") {
		
			$insert = $db->prepare("INSERT INTO bakicilar SET id = ?, parola = ?, bakici = ?, fiyat = ?, iletisim = ?, meslek = ?, sehir = ?, calisma = ?");
			$insert = $insert->execute(array($id, $parola, $bakici, $fiyat, $iletisim, $meslek, $sehir, $calisma));

			if ($insert) {
				/*$_SESSION['message'] = "Veriler Eklendi";*/

				unset($_SESSION["id"]);
				unset($_SESSION["parola"]);
				unset($_SESSION["bakici"]);
				unset($_SESSION["fiyat"]);
				unset($_SESSION["iletisim"]);
				unset($_SESSION["meslek"]);
				unset($_SESSION["sehir"]);
				unset($_SESSION["calisma"]);
				


	            header("Location: index.php");
	            exit();
			}else {
				/*$_SESSION['message'] = "Bir Hata Oldu";*/
				exit();
			}

		}else {
			/*$_SESSION['message'] = "Lütfen tüm değerleri doldurun";*/
	        header("Location: index.php");
	        exit();
		}
	}
}

// Veri Silme
if (isset($_POST['sil'])) {
	$id 	= Guvenlik($_POST['id']);
	$parola = Guvenlik($_POST['parola']);

	if ($id != "" and $parola != "") {

		$veriSor = $db->prepare("SELECT id FROM bakicilar WHERE id = ? AND parola = ?");
		$veriSor->execute(array($id, $parola));
		$veriCount = $veriSor->rowCount();

		if ($veriCount) {

			$delete = $db->prepare("DELETE FROM bakicilar WHERE id = ?");
			$delete = $delete->execute(array($id));

			if ($delete) {
				/*$_SESSION['message'] = "Veri silindi";*/
		        header("Location: index.php");
		        exit();
			} else {
				/*$_SESSION['message'] = "Bir hata oldu. Veri silinemedi";*/
		        header("Location: index.php");
		        exit();
			}
		}else {
			/*$_SESSION['message'] = "Böyle bir kayıt bulunamadı";*/
	        header("Location: index.php");
	        exit();
		}
	} else {
		/*$_SESSION['message'] = "ID ve Parola alanlarını doldurun";*/
        header("Location: index.php");
        exit();
	}
}


// Veri Düzenle
if (isset($_POST["duzenle"])) {
	$id 		= Guvenlik($_POST['id']);
	$parola 	= Guvenlik($_POST['parola']);
	$bakici 	= Guvenlik($_POST['bakici']);
	$fiyat 		= Guvenlik($_POST['fiyat']);

	$iletisim 	= Guvenlik($_POST['iletisim']);
	$meslek 	= Guvenlik($_POST['meslek']);
	$sehir 		= Guvenlik($_POST['sehir']);
	$calisma 	= Guvenlik($_POST['calisma']);
	

	if ($id != "" and $parola != "") {

		$veriSor = $db->prepare("SELECT * FROM bakicilar WHERE id = ? and parola = ?");
		$veriSor->execute(array($id, $parola));
		$veriCount = $veriSor->rowCount();

		if ($veriCount) {

			$duzenleDeger = "";
			if (isset($_POST['id']) and $_POST['id'] != "") {
				$duzenleDeger .= "id='".$_POST['id']."', ";
			}

			if (isset($_POST['parola']) and $_POST['parola'] != "") {
				$duzenleDeger .= "parola='".$_POST['parola']."', ";
			}

			if (isset($_POST['bakici']) and $_POST['bakici'] != "") {
				$duzenleDeger .= "bakici='".$_POST['bakici']."', ";
			}

			if (isset($_POST['fiyat']) and $_POST['fiyat'] != "") {
				$duzenleDeger .= "fiyat='".$_POST['fiyat']."', ";
			}

			if (isset($_POST['iletisim']) and $_POST['iletisim'] != "") {
				$duzenleDeger .= "iletisim='".$_POST['iletisim']."', ";
			}

			if (isset($_POST['meslek']) and $_POST['meslek'] != "") {
				$duzenleDeger .= "meslek='".$_POST['meslek']."', ";
			}

			if (isset($_POST['sehir']) and $_POST['sehir'] != "") {
				$duzenleDeger .= "sehir='".$_POST['sehir']."', ";
			}

			if (isset($_POST['calisma']) and $_POST['calisma'] != "") {
				$duzenleDeger .= "calisma='".$_POST['calisma']."', ";
			}

			

			$duzenleDeger = trim($duzenleDeger, ", ");

			$SQL = "UPDATE bakicilar SET $duzenleDeger WHERE id = '$id' ";

			$update = $db->prepare($SQL);
			$update = $update->execute();

			if ($update) {
				/*$_SESSION['message'] = "Kayıt güncellendi";*/
	            header("Location: index.php");
	            exit();
			} else {
				$_SESSION['message'] = "Bir Hata Oldu";
	            header("Location: index.php");
	            exit();
			}

                        
		} else {
			/*$_SESSION['message'] = "Böyle bir kayıt bulunamadı";*/
            header("Location: index.php");
            exit();
		}

	} else {
		/*$_SESSION['message'] = "ID ve Parola alanlarını doldurun";*/
        header("Location: index.php");
        exit();
	}
}

// Veri arama
if (isset($_POST["ara"])) {

	$aramaDeger = "";
	if ($_POST['id'] != "") {
		$aramaDeger .= "&id=" . $_POST['id'];
	}

	if ($_POST['parola'] !="") {
		$aramaDeger .= "&parola=" . $_POST['parola'];
	}

	if ($_POST['bakici'] !="") {
		$aramaDeger .= "&bakici=" . $_POST['bakici'];
	}

	if ($_POST['fiyat'] !="") {
		$aramaDeger .= "&fiyat=" . $_POST['fiyat'];
	}

	if ($_POST['iletisim'] !="") {
		$aramaDeger .= "&iletisim=" . $_POST['iletisim'];
	}

	if ($_POST['meslek'] !="") {
		$aramaDeger .= "&meslek=" . $_POST['meslek'];
	}

	if ($_POST['sehir'] !="") {
		$aramaDeger .= "&sehir=" . $_POST['sehir'];
	}

	if ($_POST['calisma'] !="") {
		$aramaDeger .= "&calisma=" . $_POST['calisma'];
	}

	if ($_POST['durum'] !="") {
		$aramaDeger .= "&durum=" . $_POST['durum'];
	}

        
        
	header("Location: index.php?ara=true".$aramaDeger);
}

?>
