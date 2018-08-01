<?php

	if(!isset($_POST["ime"]))
	{
		echo "Ovo nije POST metoda!";
		exit();
	}

	$ime = $_POST["ime"];
	$email = $_POST["email"];

	$sql = mysqli_connect("localhost", "root", "", "12ti_cas");

	$ime = $sql->real_escape_string($ime);

	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE IME='{$ime}' ");

	if($rezultat->num_rows == 0)
	{
		$msg= "korisnik sa imenom $ime ne postoj. Molimo vas registrujte se!";
		header("Location: error.php?message=$msg");
		exit();
	}

	$email = $sql->real_escape_string($email);

	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE EMAIL='{$email}' ");

	if($rezultat->num_rows == 0)
	{
		$msg= "korisnik sa e-mailom $email ne postoj. Molimo vas registrujte se!";
		header("Location: error.php?message=$msg");
		exit();
	}

	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE IME = '{$ime}' AND EMAIL = '{$email}' ");
	
	if($rezultat->num_rows == 0)
	{
		$msg= "Uneli ste pogresan email ili pogresno ime. Molimo vas pokusajte ponovo.";
		header("Location: error.php?message=$msg");
		exit();
	}

	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE IME = '{$ime}' AND EMAIL = '{$email}' ");
	
	if($rezultat->num_rows == 1)
	{
		header("Location: welcome.php");
	}

?>