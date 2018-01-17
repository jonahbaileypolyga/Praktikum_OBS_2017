<?php
//CREATE TABLE `obs_prak`.`obs_prak` ( `id` INT NOT NULL AUTO_INCREMENT , `kategorie` VARCHAR(255) NOT NULL , `prak_als` VARCHAR(255) NOT NULL , `name` VARCHAR(255) NOT NULL , `firmenname` VARCHAR(255) NOT NULL , `strasse` VARCHAR(255) NOT NULL , `plz` INT(255) NOT NULL , `stadt` VARCHAR(255) NOT NULL , `telefon` INT(255) NOT NULL , `fax` INT(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `webseite` VARCHAR(255) NOT NULL , `kontaktperson` VARCHAR(255) NOT NULL , `taetigkeit` VARCHAR(255) NOT NULL , `beschreibung` LONGTEXT NOT NULL , PRIMARY KEY (`id`), INDEX (`kategorie`), INDEX (`prak_als`), INDEX (`name`), INDEX (`firmenname`), INDEX (`strasse`), INDEX (`plz`), INDEX (`stadt`), INDEX (`telefon`), INDEX (`fax`), INDEX (`email`), INDEX (`webseite`), INDEX (`kontaktperson`), INDEX (`taetigkeit`)) ENGINE = InnoDB;
require_once('config.php');
$conn = mysqli_connect(
                  $servername,
                  $username,
                  $password
                );
$mysqldatabase = "'" . $datenbank . "'";

mysqli_set_charset($conn, 'utf8');

if(!$conn->connect_errno) {
  //Überprüfe eingaben
  $checkdatabase = "SHOW DATABASES LIKE " . $mysqldatabase;
  if(!($checkdatabase = $conn->query($checkdatabase))) {
    print_r($conn);
    die("QUERY Error: query in ausbildung on show DATABASES: " . $mysqldatabase);
  }
  if($checkdatabase->num_rows == 0) {
    $sql_befehl ="CREATE DATABASE IF NOT EXISTS " . $mysqldatabase;
    if(mysqli_query($conn, $sql_befehl)) {
      mysqli_select_db($conn, $datenbank);
    }else{
      die("Der MySQL-Benutzer " . $username . " hat nicht genügend Rechte um eine Datenbank zu erstellen.");
    }
  }
  mysqli_select_db($conn, $datenbank);

  $sql_befehl = "SHOW TABLES LIKE 'obs_prak'";
  if($resultat = mysqli_query($conn, $sql_befehl)) {
    if($resultat->num_rows == 0) {
      $sql_befehl = "CREATE TABLE obs_prak ( `id` INT NOT NULL AUTO_INCREMENT , `kategorie` VARCHAR(255) NOT NULL , `prak_als` VARCHAR(255) NOT NULL , `name` VARCHAR(255) NOT NULL , `firmenname` VARCHAR(255) NOT NULL , `strasse` VARCHAR(255) NOT NULL , `plz` INT(255) NOT NULL , `stadt` VARCHAR(255) NOT NULL , `telefon` INT(255) NOT NULL , `fax` INT(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `webseite` VARCHAR(255) NOT NULL , `kontaktperson` VARCHAR(255) NOT NULL , `taetigkeit` VARCHAR(255) NOT NULL , `beschreibung` LONGTEXT NOT NULL , PRIMARY KEY (`id`), INDEX (`kategorie`), INDEX (`prak_als`), INDEX (`name`), INDEX (`firmenname`), INDEX (`strasse`), INDEX (`plz`), INDEX (`stadt`), INDEX (`telefon`), INDEX (`fax`), INDEX (`email`), INDEX (`webseite`), INDEX (`kontaktperson`), INDEX (`taetigkeit`))";
      if(mysqli_query($conn, $sql_befehl)) {
        echo("Bitte die Daten nochmal eintragen. Es ist ein Fehler aufgetreten.");
        die("");
      }else{
        die("Der MySQL-Benutzer " . $username . " hat nicht genügend Rechte um eine Datenbank zu erstellen.");
      }
    }
  }else{
    die("QUERY Error, query in ausbildung on show TABLES");
  }

  $sql_befehl = "SHOW TABLES LIKE 'acceptfirma'";
  if($resultat = mysqli_query($conn, $sql_befehl)) {
    if($resultat->num_rows == 0) {
      $sql_befehl = "CREATE TABLE `obs_prak`.`accept` ( `ID` TEXT NOT NULL , `sqlbefehl` LONGTEXT NOT NULL )";
      if(mysqli_query($conn, $sql_befehl)) {
        echo("Bitte die Daten nochmal eintragen. Es ist ein Fehler aufgetreten.");
        die("");
      }else{
        die("Der MySQL-Benutzer " . $username . " hat nicht genügend Rechte um eine Datenbank zu erstellen.");
      }
    }
  }else{
    die("QUERY Error, query in ausbildung on show TABLES");
  }

} else {
  die('Keine Verbinung möglich. Ist der Benutzer richtig und das Passwort? Fehler: ' . $conn->connect_error);
}
 ?>
