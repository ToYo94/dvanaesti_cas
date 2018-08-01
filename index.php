<!DOCTYPE html>
<html>
	<head>
	<link type="text/css" rel="stylesheet" href="style.css">
		<title></title>
	</head>
	<body>
		<h1>REGISTRACIJA</h1>
		<form action="registracija.php" method="POST">
			<input type="text" name="ime" placeholder="Unesite ime" required />
			<input type="email" name="email" placeholder="Unesite e-mail" required />
			<input type="password" name="sifra" placeholder="Unesite sifru" required />
			<input type="submit" value="Registruj se" disabled id="button" />
			<p>Da li si robot? DA</p><input type="radio" name="robotcheck" required onchange="document.getElementById('button').disabled = this.checked">
			<p> NE</p><input type="radio" name="robotcheck" required onchange="document.getElementById('button').disabled = !this.checked;">
		</form>
		<h1>LOGIN</h1>
		<form action="login.php" method="POST">
			<input type="text" name="ime" placeholder="Unesite ime" required />
			<input type="email" name="email" placeholder="Unesite e-mail" required />
			<input type="submit" value="uloguj se" disabled id="button2" />
			<p>Da li si robot? DA</p><input type="radio" name="robotcheck" required onchange="document.getElementById('button2').disabled = this.checked">
			<p> NE</p><input type="radio" name="robotcheck" required onchange="document.getElementById('button2').disabled = !this.checked;">
		</form>

	<script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  	<script src="script.js"></script>

	</body>
</html>

<?php
# domaci #1 uradjen
# DOMACI ZADATAK: DODATI PROVERU DA KORISNIK NIJE ROBOT
# trebace javascript (jQuerry) i radio input.
# kada se stiklira radio skripta treba da ukloni disabled sa input type submita (hint: pogledati jQuerry attr)
# podestiti se SELECT-a (razmislite kako bi napravili proveru da li je korisnik vec registrovan)


# domaci #2
#odraditi login
#kada korisnik dodje na registracija.php ako je ulogovan odvesti ga na welcome.php (SESIJE!)

?>