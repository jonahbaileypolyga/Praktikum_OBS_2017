<?php
	if(isset($_POST['suche_enter']))
	{
		$servername = "127.0.0.1";
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
			kategorie,prak_als,name,firmenname,strasse,plz,stadt,telefon,fax,email,webseite,kontaktperson,taetigkeit,beschreibung
		FROM
			obs_prak
		WHERE
			kategorie LIKE '%".$suchbegriff."%'
			OR
			prak_als LIKE '%".$suchbegriff."%'

		ORDER BY
			kategorie,prak_als,name,firmenname,strasse,plz,stadt,telefon,fax,email,webseite,kontaktperson,taetigkeit,beschreibung
		";
		$query = mysqli_query($conn, $sql);

		echo "<ul>";
		while($row = mysqli_fetch_assoc($query))
		{
			$kategorie = $row['kategorie'];
			$prak_als = $row['prak_als'];
			$name = $row['name'];
			$firmenname = $row['firmenname'];
			$strasse = $row['strasse'];
			$plz = $row['plz'];
			$stadt = $row['stadt'];
			$telefon = $row['telefon'];
			$fax = $row['fax'];
			$email = $row['email'];
			$webseite = $row['webseite'];
			$kontaktperson = $row['kontaktperson'];
			$taetigkeit = $row['taetigkeit'];
			$beschreibung = $row['beschreibung'];

			echo("<li>Firmenname: ".$firmenname." | Kategorie: ".$kategorie." | Telefon: ".$telefon."  | Email: ".$email." | PLZ: ".$plz."</li>");
			print_r("<a href=".$webseite.">Zur Webseite</a>");
		}
		echo "</ul>";
		mysqli_close($conn);
	}
	?>
