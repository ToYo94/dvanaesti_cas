<?php

	if(!isset($_POST["ime"]))
	{
		echo "Ovo nije POST metoda!";
		exit();
	}

	$ime = $_POST["ime"];
	$sifra = $_POST["sifra"];
	$email = $_POST["email"];

	#potrebno je uraditi proveru da korisnik nije uneo ime ili sifru samo prazna polja
	#strlen - duzina stringa
	#trim - skida prazna polja
	if( strlen(trim($ime) ) < 1)
	{
		echo "Molimo vas da unesete ime koje ne sadrzi samo prazan prostor!";
		exit();
	}

	if( strlen(trim($sifra) ) < 1)
	{
		echo "Molimo vas da unesete sifru koja ne sadrzi samo prazan prostor!";
		exit();
	}

	if( strlen(trim($email) ) < 1)
	{
		echo "Molimo vas da unesete email koji ne sadrzi samo prazan prostor!";
		exit();
	}

	#strpos tj string position proverava da li neka rec (u ovom slucaju varijabla) sadrzi neki simbol. takodje sa !stringpos kazemo ako ne sadrzi da ispise poruku email mora da sadrzi @!
	if( !strpos($email, "@") )
	{
	echo "Email mora da sadrzi @!";
	exit();
	}

# SELECT ID FROM korisnici WHERE IME=$ime

	$sql = mysqli_connect("localhost", "root", "", "12ti_cas");

#PDO & Prepared Statements < procitati o ovome
	$ime = $sql->real_escape_string($ime);

	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE IME='{$ime}' ");
#	var_dump($rezultat);

	if($rezultat->num_rows >= 1)
	{
		$msg= "korisnik $ime vec postoj. Molimo vas ulogujte se!";
		header("Location: error.php?message=$msg");
		exit();
	}

	$email = $sql->real_escape_string($email);

	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE EMAIL='{$email}' ");

	if($rezultat->num_rows >= 1)
	{
		$msg= "korisnik sa e-mailom $email postoj. Molimo vas ulogujte se!";
		header("Location: error.php?message=$msg");
		exit();
	}

	$sifra = hash("sha256", $sifra);
	$sifra = $sql->real_escape_string($sifra);
	$time = time();

	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE IME = '{$ime}' AND PASSWORD = '{$sifra}' AND EMAIL = '{$email}'");

	if($rezultat->num_rows >= 1)
	{
		header("Location: welcome.php");
		exit();
	}


	$sql->query("INSERT INTO korisnici (IME, PASSWORD, EMAIL, TIMEOFREGISTRATION)
			VALUES ('{$ime}', '{$sifra}', '{$email}', '{$time}' )");

	header("Location: welcome.php");
?>