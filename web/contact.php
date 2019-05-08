<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kontakt</title>
	<link rel="stylesheet" href="asserts/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link rel="stylesheet" href="asserts/css/animate.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("favicon.php"); ?>
</head>
<body>
	<header>
		<?php include "nav.php"; ?>
	</header>
	<main>
		<div class=container>
			<br><br>
			<div class="row animated fadeInRight">
				<div class="col-lg-8">
					<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2660.5174684471267!2d15.080216515016907!3d48.17738047922666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sit+htl+ybbs!5e0!3m2!1sde!2sat!4v1554965187104!5m2!1sde!2sat" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="col-lg-4" style="padding: 10px; color: black">
					<h5>Adresse</h5><hr style="background: white; margin: -4px;">
					<p>Schulring 1<br>
					3370 Ybbs an der Donau</p>
					<br>
					<h5>Email</h5><hr style="background: white; margin: -4px;">
					<p>Andreas.Brachinger@sz-ybbs.ac.at
						Juergen.Altermueller@sz-ybbs.ac.at
					</p>
					<br>
					<h5>Öffnungszeiten</h5><hr style="background: white; margin: -4px;">
					<p>Mo - Fr | 7:30 - 12:00</p>
				</div>
			</div><br><br>
			

			<div class="row animated fadeInRight">
				<h1 class="animated fadeInRight col-12">Stay Close</h1><br>
			
				  <div class="form-group col-lg-6 col-sm-12">
					<label for="exampleInputEmail1">Email Adresse</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
				  </div>
				  <div class="form-group col-lg-6 col-sm-12">
					<label for="exampleInputEmail1">Betreff</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Betreff">
				  </div>
				<div class="form-group col-lg-12">
				  <label for="exampleFormControlTextarea3">Nachricht</label>
				  <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" style="resize: none;"></textarea>
				</div>
			
			</div>
			<div class="row animated fadeInRight justify-content-md-center">
				<button class="btn btn-outline-primary">Absenden</button>
			</div>
		</div>
	</main>
	<br><br>
	<?php include "footer.php"; ?>
</body>
</html>