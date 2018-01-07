<?php
	if(isset($_POST['suche_enter']))
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "firmen";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (mysqli_connect_errno()) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$suchbegriff = trim(htmlentities(stripslashes(mysqli_real_escape_string($conn, $_POST['suchfeld']))));

		$sql = "
		SELECT
			name,telefonnr,email,abteil,link
		FROM
			firmen
		WHERE
			name LIKE '%".$suchbegriff."%'
			OR
			abteil LIKE '%".$suchbegriff."%'

		ORDER BY
			name,telefonnr,email,abteil,link
		";
		$query = mysqli_query($conn, $sql);

		echo "<ul>";
		while($row = mysqli_fetch_assoc($query))
		{
			$name = $row['name'];
			$telefonnr = $row['telefonnr'];
			$email = $row['email'];
			$abteil = $row['abteil'];
			$link = $row['link'];

			echo("<li>Name: ".$name." | Telefon: ".$telefonnr."  | Email: ".$email." | Abteil: ".$abteil."</li>");
			print_r("<a href=".$link.">Zur Webseite</a>");
		}
		echo "</ul>";
		mysqli_close($conn);
	}
	?>
