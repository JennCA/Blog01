<!DOCTYPE html>
<html lang="de" class="gr_localhost">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<form name="my-form" action="formular.php" method="POST">
		<div class="form-field">
			<label for="username">Username</label>
			<input type="text" id="username" name="username">
		</div>
		<div class="form-field">
			<label for="password">Passwort</label>
			<input type="password" id="password" name="password">
		</div>
		<input type="submit" value="Login">
	</form>
  <?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Formular erhalten
        echo '<p>Formular wurde abgeschickt...</p>';
        //var_dump($_POST);

        $username = $_POST["username"];
        $password = $_POST["password"];
        if ($username == '' || $password == '') {

          echo '<p>Pfui! Username und/oder Passwort leer!</p>';

        }
        else {
          echo '<p>Username: ' . $username. '</p>';
          echo '<p>Passwort: ' . $password . '</p>';

          // Daten in Datenbank einfügen
          // 1: Verbindung mit der Datenbank herstellen
          $dbVerbindung = new PDO('mysql:host=localhost;dbname=testdb', 'root', '');
          // 2: Daten in die Datenbank einfügen
          // (nicht gut, weil SQL-Injection möglich ist)
          //  $sqlBefehl = $dbVerbindung->query("INSERT INTO persons(username, password) VALUES ('$username', '$password')");
          // besser so, mit "prepare" und Parametern --> SQL-Injection ist nicht mehr möglich.
          $sqlBefehl = $dbVerbindung->prepare("INSERT INTO persons(username, password) VALUES (:uname, :pw)");
          $sqlBefehl->execute(array(":uname" => $username, ":pw" => $password));
        }

        // 2. Aufgabe: Eingaben sollen in den Eingabefeldern stehen bleiben.
    }
    ?>
    <?php
      // 1: Verbindung mit der Datenbank herstellen
      $dbVerbindung = new PDO('mysql:host=localhost;dbname=testdb', 'root', '');

      // 2: Mit SELECT Daten von Datenbank abholen und ausgeben (foreach)
      $sqlBefehl = $dbVerbindung->prepare('SELECT * FROM persons');
      $sqlBefehl->execute();
      foreach($sqlBefehl->fetchAll() as $x) {
          //var_dump($x);
          if($_SERVER['REQUEST_METHOD'] === 'POST') {


          echo 'ID: ' . $x[0] . '<br />';
          echo 'Benutzer: ' . $x[1] . '<br />';
          echo 'Passwort: ' . $x[2] . '<br />';
          echo '<hr>';
        }
      }

    ?>
</body>
</html>
