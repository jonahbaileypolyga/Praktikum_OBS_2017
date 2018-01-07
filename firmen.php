<?php
	if(isset($_POST['suche_enter']))
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "obs_prak";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (mysqli_connect_errno()) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$suchbegriff = trim(htmlentities(stripslashes(mysqli_real_escape_string($conn, $_POST['suchfeld']))));

		$sql = "
		SELECT
			name,telefonnr,email,abteil,link
		FROM
			obs_prak
		WHERE
			name LIKE '%".$suchbegriff."%'
			OR
			kategorie LIKE '%".$suchbegriff."%'

		ORDER BY
			name,telefonnr,email,prak_als,kategorie,webseite
		";
		$query = mysqli_query($conn, $sql);

		echo "<ul>";
		while($row = mysqli_fetch_assoc($query))
		{
			$name = $row['name'];
			$telefonnr = $row['telefonnr'];
			$email = $row['email'];
			$prak_als = $row['prak_als'];
			$kategorie = $row['kategorie'];
			$webseite = $row['webseite'];

			echo("<li>Name: ".$name." | Telefon: ".$telefonnr."  | Email: ".$email." | Praktikum als: ".$prak_als." | Kategorie: ".$kategorie."</li>");
			print_r("<a href=".$webseite.">Zur Webseite</a>");
		}
		echo "</ul>";
		mysqli_close($conn);
	}
	?>
