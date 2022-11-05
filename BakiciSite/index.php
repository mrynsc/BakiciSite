<?php

include_once ("db.php");

	if (isset($_GET['ara'])) { // Arama işlemleri

		$aramaDeger = "";
		$sirala = "";

		if (isset($_GET['id'])) {
			$aramaDeger .= "id='".$_GET['id']."' and ";
		}

		if (isset($_GET['parola'])) {
			$aramaDeger .= "parola='".$_GET['parola']."' and ";
		}

		if (isset($_GET['bakici'])) {
			$aramaDeger .= "bakici='".$_GET['bakici']."' and ";
		}

		if (isset($_GET['fiyat'])) {
			$aramaDeger .= "fiyat='".$_GET['fiyat']."' and ";
		}

		if (isset($_GET['iletisim'])) {
			$aramaDeger .= "iletisim='".$_GET['iletisim']."' and ";
		}

		if (isset($_GET['meslek'])) {
			$aramaDeger .= "meslek='".$_GET['meslek']."' and ";
		}

		if (isset($_GET['sehir'])) {
			$aramaDeger .= "sehir='".$_GET['sehir']."' and ";
		}

		if (isset($_GET['calisma'])) {
			$aramaDeger .= "calisma='".$_GET['calisma']."' and ";
		}

		$aramaDegerSon = trim($aramaDeger, " and ");

		if (isset($_GET['durum'])) {

			
			
			if ($_GET['durum'] == "1") {

				
				$sirala .= "ORDER BY fiyat DESC LIMIT 1";

			}elseif ($_GET['durum'] == "2") {
				
				$sirala .= "ORDER BY fiyat ASC LIMIT 1";
			}elseif ($_GET['durum'] == "3") {

				
				$sirala .= "ORDER BY fiyat DESC";
				
			}elseif ($_GET['durum'] == "4") {

				$sirala .= "ORDER BY fiyat ASC";
			}

			$_SESSION["durum"] 		= $_GET['durum'];
			
		}

		if ($aramaDegerSon == "") {

			$SQL = "SELECT * FROM bakicilar $sirala";

			

		}else{
			
			$SQL = "SELECT * FROM bakicilar WHERE $aramaDegerSon $sirala";

		}

	}else{
		$SQL = "SELECT * FROM bakicilar ORDER BY fiyat asc";
	}

	$sorgu = $db->query($SQL);
	$bakicilar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

	?>
	<!doctype html>
		<html lang="tr">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<!-- Bootstrap CSS -->
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
			<title>Bakıcılar</title>
			<link rel="stylesheet" href="custom_table.css">
		</head>
		<body>

			<div class="container-fluid p-3">
				<div class="row">
					<div class="col-3">
						<div class="col-12">
							<?php
							if(isset($_SESSION['message'])) { ?>

								<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
									<strong></strong> <?= $_SESSION['message']; ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php }
							unset($_SESSION['message']);
							?>
						</div>
						<form method="post" action="action.php">
							<div class="mb-3 row">
								<label  for="id" class="col-sm-4 col-form-label"><b>ID</b></label>
								<div class="col-sm-8">
									<input autocomplete="off" type="text" class="form-control form-control-sm" name="id" id="id" value="<?php if(isset($_SESSION['id'])){ echo $_SESSION['id']; unset($_SESSION['id']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label   for="parola" class="col-sm-4 col-form-label " ><b>PAROLA</b></label>
								<div class="col-sm-8">
									<input  autocomplete="off" type="text" class="form-control form-control-sm" name="parola" id="parola" value="<?php if(isset($_SESSION['parola'])){ echo $_SESSION['parola']; unset($_SESSION['parola']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label for="bakici" class="col-sm-4 col-form-label"><b>BAKICI</b></label>
								<div class="col-sm-8">
									<input   autocomplete="off" type="text" class="form-control form-control-sm" name="bakici" id="bakici" value="<?php if(isset($_SESSION['bakici'])){ echo $_SESSION['bakici']; unset($_SESSION['bakici']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label for="meslek" class="col-sm-4 col-form-label"><b>İŞ</b></label>
								<div class="col-sm-8">
									<select class="form-select form-select-sm" id="meslek" name="meslek">
										<option></option>
										<option value="Öz Bakım" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım</option>
										<option value="Ev Temizliği" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Ev Temizliği"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Ev Temizliği</option>
										<option value="Yemek" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Yemek"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Yemek</option>
										<option value="Kıyafet Düzeni" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Kıyafet Düzeni"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Kıyafet Düzeni</option>
										<option value="Öz Bakım ve Ev Temizliği" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım ve Ev Temizliği"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım ve Ev Temizliği</option>
										<option value="Öz Bakım ve Yemek" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım ve Yemek"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım ve Yemek</option>
										<option value="Öz Bakım ve Kıyafet Düzeni" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım ve Kıyafet Düzeni"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım ve Kıyafet Düzeni</option>
										<option value="Öz Bakım ve Ev Temizliği ve Yemek" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım ve Ev Temizliği ve Yemek"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım ve Ev Temizliği ve Yemek</option>
										<option value="Öz Bakım ve Ev Temizliği ve Kıyafet Düzeni" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım ve Ev Temizliği ve Kıyafet Düzeni"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım ve Ev Temizliği ve Kıyafet Düzeni</option>
										<option value="Öz Bakım ve Yemek ve Kıyafet Düzeni" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım ve Yemek ve Kıyafet Düzeni"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım ve Yemek ve Kıyafet Düzeni</option>
										<option value="Öz Bakım ve Ev Temizliği ve Yemek ve Kıyafet Düzeni" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım ve Ev Temizliği ve Yemek ve Kıyafet Düzeni"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım ve Ev Temizliği ve Yemek ve Kıyafet Düzeni</option>


									</select>
								</div>
							</div>


							<div class="mb-3 row">
								<label for="sehir" class="col-sm-4 col-form-label"><b>ŞEHİR</b></label>
								<div class="col-sm-8">
									<select class="form-select form-select-sm" id="sehir" name="sehir">
										<option></option>
										<option value="Adana" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Adana"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Adana</option>
										<option value="Adıyaman" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Adıyaman"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Adıyaman</option>
										<option value="Afyonkarahisar" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Afyonkarahisar"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Afyonkarahisar</option>
										<option value="Ağrı" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Ağrı"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Ağrı</option>
										<option value="Amasya" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Amasya"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Amasya</option>
										<option value="Ankara" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Ankara"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Ankara</option>
										<option value="Antalya" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Antalya"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Antalya</option>
										<option value="Artvin" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Artvin"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Artvin</option>
										<option value="Aydın" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Aydın"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Aydın</option>
										<option value="Balıkesir" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Balıkesir"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Balıkesir</option>
										<option value="Bilecik" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Bilecik"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Bilecik</option>
										<option value="Bingöl" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Bingöl"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Bingöl</option>
										<option value="Bitlis" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Bitlis"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Bitlis</option>
										<option value="Bolu" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Bolu"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Bolu</option>
										<option value="Burdur" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Burdur"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Burdur</option>
										<option value="Bursa" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Bursa"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Bursa</option>
										<option value="Çanakkale" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Çanakkale"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Çanakkale</option>
										<option value="Çankırı" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Çankırı"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Çankırı</option>
										<option value="Çorum" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Çorum"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Çorum</option>
										<option value="Denizli" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Denizli"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Denizli</option>
										<option value="Diyarbakır" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Diyarbakır"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Diyarbakır</option>
										<option value="Edirne" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Edirne"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Edirne</option>
										<option value="Elazığ" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Elazığ"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Elazığ</option>
										<option value="Erzincan" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Erzincan"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Erzincan</option>
										<option value="Erzurum" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Erzurum"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Erzurum</option>
										<option value="Eskişehir" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Eskişehir"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Eskişehir</option>
										<option value="Gaziantep" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Gaziantep"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Gaziantep</option>
										<option value="Giresun" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Giresun"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Giresun</option>
										<option value="Gümüşhane" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Gümüşhane"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Gümüşhane</option>
										<option value="Hakkari" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Hakkari"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Hakkari</option>
										<option value="Hatay" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Hatay"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Hatay</option>
										<option value="Isparta" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Isparta"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Isparta</option>
										<option value="Mersin" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Mersin"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Mersin</option>
										<option value="İstanbul" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "İstanbul"){ echo "selected"; unset($_SESSION['sehir']);} ?>>İstanbul</option>
										<option value="İzmir" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "İzmir"){ echo "selected"; unset($_SESSION['sehir']);} ?>>İzmir</option>
										<option value="Kars" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kars"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kars</option>
										<option value="Kastamonu" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kastamonu"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kastamonu</option>
										<option value="Kayseri" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kayseri"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kayseri</option>
										<option value="Kırklareli" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kırklareli"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kırklareli</option>
										<option value="Kırşehir" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kırşehir"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kırşehir</option>
										<option value="Kocaeli" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kocaeli"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kocaeli</option>
										<option value="Konya" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Konya"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Konya</option>
										<option value="Kütahya" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kütahya"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kütahya</option>
										<option value="Malatya" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Malatya"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Malatya</option>
										<option value="Manisa" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Manisa"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Manisa</option>
										<option value="Kahramanmaraş" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kahramanmaraş"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kahramanmaraş</option>
										<option value="Mardin" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Mardin"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Mardin</option>
										<option value="Muğla" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Muğla"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Muğla</option>
										<option value="Muş" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Muş"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Muş</option>
										<option value="Nevşehir" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Nevşehir"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Nevşehir</option>
										<option value="Niğde" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Niğde"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Niğde</option>
										<option value="Ordu" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Ordu"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Ordu</option>
										<option value="Rize" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Rize"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Rize</option>
										<option value="Sakarya" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Sakarya"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Sakarya</option>
										<option value="Samsun" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Samsun"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Samsun</option>
										<option value="Siirt" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Siirt"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Siirt</option>
										<option value="Sinop" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Sinop"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Sinop</option>
										<option value="Sivas" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Sivas"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Sivas</option>
										<option value="Tekirdağ" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Tekirdağ"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Tekirdağ</option>
										<option value="Tokat" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Tokat"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Tokat</option>
										<option value="Trabzon" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Trabzon"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Trabzon</option>
										<option value="Tunceli" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Tunceli"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Tunceli</option>
										<option value="Şanlıurfa" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Şanlıurfa"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Şanlıurfa</option>
										<option value="Uşak" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Uşak"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Uşak</option>
										<option value="Van" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Van"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Van</option>
										<option value="Yozgat" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Yozgat"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Yozgat</option>
										<option value="Zonguldak" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Zonguldak"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Zonguldak</option>
										<option value="Aksaray" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Aksaray"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Aksaray</option>
										<option value="Bayburt" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Bayburt"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Bayburt</option>
										<option value="Karaman" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Karaman"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Karaman</option>
										<option value="Kırıkkale" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kırıkkale"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kırıkkale</option>
										<option value="Batman" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Batman"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Batman</option>
										<option value="Şırnak" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Şırnak"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Şırnak</option>
										<option value="Bartın" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Bartın"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Bartın</option>
										<option value="Ardahan" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Ardahan"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Ardahan</option>
										<option value="Iğdır" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Iğdır"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Iğdır</option>
										<option value="Yalova" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Yalova"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Yalova</option>
										<option value="Karabük" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Karabük"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Karabük</option>
										<option value="Kilis" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Kilis"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Kilis</option>
										<option value="Osmaniye" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Osmaniye"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Osmaniye</option>
										<option value="Düzce" <?php if(isset($_SESSION['sehir']) AND $_SESSION['sehir'] == "Düzce"){ echo "selected"; unset($_SESSION['sehir']);} ?>>Düzce</option>

                                                                        
                                                                        
                                                                        </select>
								</div>
							</div>

							<div class="mb-3 row">
								<label for="calisma" class="col-sm-4 col-form-label"><b>ÇALIŞMA</b></label>
								<div class="col-sm-8">
									<select class="form-select form-select-sm" id="calisma" name="calisma">
										<option></option>
										<option value="Haftada 1 gün - Gündüz" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 1 gün - Gündüz"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 1 gün - Gündüz</option>
										<option value="Haftada 1 gün - Gece" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 1 gün - Gece"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 1 gün - Gece</option>
										<option value="Haftada 1 gün - Yatılı" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 1 gün - Yatılı"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 1 gün - Yatılı</option>
										<option value="Haftada 2 gün - Gündüz" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 2 gün - Gündüz"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 2 gün - Gündüz</option>
										<option value="Haftada 2 gün - Gece" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 2 gün - Gece"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 2 gün - Gece</option>
										<option value="Haftada 2 gün - Yatılı" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 2 gün - Yatılı"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 2 gün - Yatılı</option>
										<option value="Haftada 3 gün - Gündüz" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 3 gün - Gündüz"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 3 gün - Gündüz</option>
										<option value="Haftada 3 gün - Gece" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 3 gün - Gece"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 3 gün - Gece</option>
										<option value="Haftada 3 gün - Yatılı" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 3 gün - Yatılı"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 3 gün - Yatılı</option>
										<option value="Haftada 4 gün - Gündüz" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 4 gün - Gündüz"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 4 gün - Gündüz</option>
										<option value="Haftada 4 gün - Gece" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 4 gün - Gece"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 4 gün - Gece</option>
										<option value="Haftada 4 gün - Yatılı" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 4 gün - Yatılı"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 4 gün - Yatılı</option>
										<option value="Haftada 5 gün - Gündüz" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 5 gün - Gündüz"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 5 gün - Gündüz</option>
										<option value="Haftada 5 gün - Gece" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 5 gün - Gece"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 5 gün - Gece</option>
										<option value="Haftada 5 gün - Yatılı" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 5 gün - Yatılı"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 5 gün - Yatılı</option>
										<option value="Haftada 6 gün - Gündüz" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 6 gün - Gündüz"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 6 gün - Gündüz</option>
										<option value="Haftada 6 gün - Gece" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 6 gün - Gece"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 6 gün - Gece</option>
										<option value="Haftada 6 gün - Yatılı" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 6 gün - Yatılı"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 6 gün - Yatılı</option>
										<option value="Haftada 7 gün - Gündüz" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 7 gün - Gündüz"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 7 gün - Gündüz</option>
										<option value="Haftada 7 gün - Gece" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 7 gün - Gece"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 7 gün - Gece</option>
										<option value="Haftada 7 gün - Yatılı" <?php if(isset($_SESSION['calisma']) AND $_SESSION['calisma'] == "Haftada 7 gün - Yatılı"){ echo "selected"; unset($_SESSION['calisma']);} ?>>Haftada 7 gün - Yatılı</option>

                                                                        
                                                                        
                                                                        
                                                                        
                                                                        </select>
								</div>
							</div>





							<div class="mb-3 row">
								<label for="fiyat" class="col-sm-4 col-form-label"><b>FİYAT</b></label>
								<div class="col-sm-8">
									<input  autocomplete="off" type="number" class="form-control form-control-sm" name="fiyat" id="fiyat" value="<?php if(isset($_SESSION['fiyat'])){ echo $_SESSION['fiyat']; unset($_SESSION['fiyat']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label for="iletisim" class="col-sm-4 col-form-label"><b>İLETİŞİM</b></label>
								<div class="col-sm-8">
									<input autocomplete="off"  type="text" class="form-control form-control-sm" name="iletisim" id="iletişim" value="<?php if(isset($_SESSION['iletisim'])){ echo $_SESSION['iletisim']; unset($_SESSION['iletisim']);} ?>">
								</div>
							</div>

							

						
						
							<div class="mb-3 row">
								<label for="durum" class="col-sm-4 col-form-label"><b>DURUM</b></label>
								<div class="col-sm-8">
									<select class="form-select form-select-sm" id="durum" name="durum">
										<option></option>
										<option value="1" <?php if(isset($_SESSION['durum']) AND $_SESSION['durum'] == "1"){ echo "selected"; unset($_SESSION['durum']);} ?>>En Yüksek Fiyat</option>
										<option value="2" <?php if(isset($_SESSION['durum']) AND $_SESSION['durum'] == "2"){ echo "selected"; unset($_SESSION['durum']);} ?>>En Düşük Fiyat</option>
										<option value="3" <?php if(isset($_SESSION['durum']) AND $_SESSION['durum'] == "3"){ echo "selected"; unset($_SESSION['durum']);} ?>>En Yüksek Fiyattan En Düşük Fiyata</option>
										<option value="4" <?php if(isset($_SESSION['durum']) AND $_SESSION['durum'] == "4"){ echo "selected"; unset($_SESSION['durum']);} ?>>En Düşük Fiyattan En Yüksek Fiyata</option>
						
                                                                        </select>
                                                                   
								</div>
							</div>
 
							<div class="mb-3 row">

								<div class='d-grid gap-2 col-6 mx-auto'>
									<button style="margin-left: 50px;  margin-top: 5px;"  type="submit" name="ekle" class="btn btn-dark  rounded-0"><b>EKLE</b></button>
  
                                                                                                                                                
									<button style="margin-left: 50px; margin-top: 10px;" type="submit" name="duzenle" class="btn btn-dark rounded-0"><b>GÜNCELLE</b></button>

								</div>

								

								<div class="d-grid gap-2 col-6 mx-auto">
									<button style="margin-right: 50px; margin-top: 5px;"   type="submit" name="ara"  class="btn btn-dark  rounded-0"><b>OKU</b></button>
                                                                                                                                                

									<button style="margin-right: 50px; margin-top: 10px;"  type="submit" name="sil" class="btn btn-dark rounded-0"><b> SİL</b></button>
								</div>

							</div>

						</form>

					</div>

                                        		                                         		  
					<div class="col-sm-9" style="border: 1px solid black; overflow: auto; height: calc(100vh - 40px);">
                                            
						<table class="tablo table">
							<thead>
								<tr>
									<th scope="col">BAKICI</th>
									<th scope="col">İŞ</th>
									<th scope="col">ŞEHİR</th>
									<th scope="col">ÇALIŞMA</th>
									<th scope="col">FİYAT</th>

									<th scope="col">İLETİŞİM</th>
								</tr>
							</thead>
							<tbody >

								<?php foreach ($bakicilar as $bakici) { ?>
									<tr>
										<td><?= $bakici["bakici"]; ?></td>
										<td><?= $bakici["meslek"]; ?></td>
										<td><?= $bakici["sehir"]; ?></td>
										<td><?= $bakici["calisma"]; ?></td>
										<td><?= $bakici["fiyat"]; ?></td>
										<td><?= $bakici["iletisim"]; ?></td>
									</tr>
								<?php } ?>

							</tbody>
						</table>
					</div>

				</div>

			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
	</html>
