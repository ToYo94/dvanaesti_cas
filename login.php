<?php

	if(!isset($_POST["email"]))
	{
		echo "Ovo nije POST metoda!";
		exit();
	}

	if(session_status() == PHP_SESSION_NONE)
	{
		session_start();
	}

	if( isset($_SESSION['ulogovan']))
	{
		echo "ERROR: Vec ste ulogovani!";
		exit();
	}

	$email = $_POST["email"];
	$password= $_POST["sifra"];

	$sql = mysqli_connect("localhost", "root", "", "12ti_cas");

	$email = $sql->real_escape_string($email);

	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE EMAIL='{$email}' ");

	if($rezultat->num_rows == 0)
	{
		$msg= "korisnik sa e-mailom $email ne postoj. Molimo vas registrujte se!";
		header("Location: error.php?message=$msg");
		exit();
	}

/*	$rezultat = $sql->query("SELECT ID FROM korisnici WHERE IME = '{$ime}' AND EMAIL = '{$email}' ");
	
	if($rezultat->num_rows == 0)
	{
		$msg= "Uneli ste pogresan email ili pogresno ime. Molimo vas pokusajte ponovo.";
		header("Location: error.php?message=$msg");
		exit();
	} */

	$password = hash("sha256", $password);
	$password = $sql->real_escape_string($password);

	$query = "SELECT ID FROM korisnici WHERE EMAIL='{$email}' AND PASSWORD='{$password}'";
	$result = $sql->query($query);
	
	# $result['num_rows']
	if($result->num_rows == 1)
	{
		echo "Uspesno ste se ulogovali!";
		$_SESSION['ulogovan'] = true;
		header("Refresh:4; url=index.php");
	} 
	else 
		{
			$query = "SELECT ID FROM korisnici WHERE EMAIL='{$email}'"; 
			$result = mysqli_query($sql, $query);

		if($result->num_rows == 1)
		{
			$msg= "Pogresan email/sifra. Pokusajte ponovo.";
			header("Location: error.php?message=$msg");
		} else
		{
			$msg= "korisnik sa e-mailom $email ne postoj. Molimo vas registrujte se!";
			header("Location: error.php?message=$msg");
		}
	}
	
	
/*	{
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, 'adea232afdc01fb4aae642119f254218bded09816a693413c5f3dd97c3b49eec')){
        header("Location: welcome.php");
    } else
        print "The email or password do not match";
	} */
?>