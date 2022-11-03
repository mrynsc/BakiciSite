<?php

include_once ("db.php");

	if (isset($_GET['ara'])) { // Arama işlemleri

		$aramaDeger = "";

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

		if (isset($_GET['durum'])) {
			$aramaDeger .= "durum='".$_GET['durum']."' and ";
		}

		$aramaDegerSon = trim($aramaDeger, " and ");

		if ($aramaDegerSon == "") {
			$SQL = "SELECT * FROM bakicilar";
		}else{
			$SQL = "SELECT * FROM bakicilar WHERE $aramaDegerSon ORDER BY fiyat asc";
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
									<input type="text" class="form-control form-control-sm" name="id" id="id" value="<?php if(isset($_SESSION['id'])){ echo $_SESSION['id']; unset($_SESSION['id']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label   for="parola" class="col-sm-4 col-form-label " ><b>PAROLA</b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control form-control-sm" name="parola" id="parola" value="<?php if(isset($_SESSION['parola'])){ echo $_SESSION['parola']; unset($_SESSION['parola']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label for="bakici" class="col-sm-4 col-form-label"><b>BAKICI</b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control form-control-sm" name="bakici" id="bakici" value="<?php if(isset($_SESSION['bakici'])){ echo $_SESSION['bakici']; unset($_SESSION['bakici']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label for="fiyat" class="col-sm-4 col-form-label"><b>FİYAT</b></label>
								<div class="col-sm-8">
									<input type="number" class="form-control form-control-sm" name="fiyat" id="fiyat" value="<?php if(isset($_SESSION['fiyat'])){ echo $_SESSION['fiyat']; unset($_SESSION['fiyat']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label for="iletisim" class="col-sm-4 col-form-label"><b>İLETİŞİM</b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control form-control-sm" name="iletisim" id="iletişim" value="<?php if(isset($_SESSION['iletisim'])){ echo $_SESSION['iletisim']; unset($_SESSION['iletisim']);} ?>">
								</div>
							</div>

							<div class="mb-3 row">
								<label for="meslek" class="col-sm-4 col-form-label"><b>İŞ</b></label>
								<div class="col-sm-8">
									<select class="form-select form-select-sm" id="meslek" name="meslek">
										<option></option>
										<option value="Öz Bakım" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım</option>
										<option value="Ev Temizliği" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Ev Temizliği"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Ev Temizliği</option>
										<option value="Öz Bakım" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım</option>
										<option value="Öz Bakım ve Ev Temizliği" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım ve Ev Temizliği"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım ve Ev Temizliği</option>
										<option value="Öz Bakım" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz Bakım</option>
										<option value="Öz bakım ve Ev temizliği ve Yemek ve Kıyafet düzeni" <?php if(isset($_SESSION['meslek']) AND $_SESSION['meslek'] == "Öz Bakım"){ echo "selected"; unset($_SESSION['meslek']);} ?>>Öz bakım ve Ev temizliği ve Yemek ve Kıyafet düzeni</option>


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
									</select>
								</div>
							</div>

							<div class="mb-3 row">
								<label for="durum" class="col-sm-4 col-form-label"><b>DURUM</b></label>
								<div class="col-sm-8">
									<select class="form-select form-select-sm" id="durum" name="durum">
										<option></option>
										<option value="En Yüksek Fiyat" <?php if(isset($_SESSION['durum']) AND $_SESSION['durum'] == "En Yüksek Fiyat"){ echo "selected"; unset($_SESSION['durum']);} ?>>En Yüksek Fiyat</option>
										<option value="En Düsük Fiyat" <?php if(isset($_SESSION['durum']) AND $_SESSION['durum'] == "En Düsük Fiyat"){ echo "selected"; unset($_SESSION['durum']);} ?>>En Düsük Fiyat</option>
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