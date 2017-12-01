<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blog01</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
  body {
      background-image: url("http://i66.tinypic.com/s2a9uf.png");
      background-repeat: space;
      background-size: 1900px;
      background-position: center;
      background-color: black;
  }
  </style>
</head>
<body>

  <div id="logo">
  <h1 class="site-title">Conspiracy FLOK</a></h1>
            <p class="site-description">WHAT IS TRUE???<p>Be sure to visit our
              <a href="#" onClick="javascript:window.open('friends.php', 'popUpIps', 'top=100, left=100, resizable=yes, scrollbars=yes, toolbar=yes, location=yes')">FRIENDS</a>.</p></p>
</div>


  <div id="respond" class="comment-respond">
      <form name="my-form" action="Blog01.php" method="POST">
        <div class="form-field">
          <label for="username">Nickname</label>
          <input type="text" id="username" name="username">
        </div>
        <div class="my-form">
          <label for="email">E-Mail<br /></label>
          <input type="text" id="email" name="email">
        </div>
        <div class="form-field">
    			<label for="password">Passwort</label>
    			<input type="password" id="password" name="password">
        <div class="my-form">
          <label for="textarea"><br></label>
          <textarea id="comment" name="comment" cols="110" rows="22" aria-required="true"></textarea>
        </div>
        <input type="submit" value="Submit">
      </form>
  			</div>


<?php
$dbVerbindung = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
if($_SERVER['REQUEST_METHOD'] === 'GET') {

  if (!empty($_GET['id'])&& !empty($_GET['fn'])) {
    echo '<p>Thank you for the feedback!</p>';
    // load comment $_GET['fn']
      $id = $_GET['id'];
       $rating = 1;
      if ($_GET['fn'] == "rateMinus") {
          $rating = -1;
      }
    $count = $dbVerbindung->exec("UPDATE blog SET bewertung = bewertung + $rating WHERE id = $id");
  }
}
          if($_SERVER['REQUEST_METHOD'] === 'POST') {
              echo '<p>Thank you for your contribution.</p>';
              //var_dump($_POST);

              $username = $_POST["username"];
              $email = $_POST["email"];
              $password = $_POST["password"];
              $text = htmlspecialchars($_POST["comment"]);
              $text = str_replace("&lt;img", "<img", $text);
              $text = str_replace("/&gt;", "/>", $text);

              if ($username == '' || $email == '' || $password == '' || $text == '') {

                echo '<p>You forgot to write your Username, E-Mail, Passwort or the Text.</p>';

              }
              else if(strpos($text, ' ') === false) {
                echo '<p>Please ensure that your post contains at least one space (" ").</p>';
              }
              else {
                echo '<p>Username: ' . $username. '</p>';
                echo '<p>E-Mail: ' . $email . '</p>';
                echo '<p>Passwort: ' . $password . '</p>';
                echo '<p>Text: ' . $text . '</p>';

                $dbVerbindung = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

                $sqlBefehl = $dbVerbindung->prepare("INSERT INTO blog (username, email, passwort, text, date, bewertung) VALUES (:uname, :email, :pw, :txt, now(), :rate");
                $sqlBefehl->execute(array(":uname" => $username, ":email" => $email, ":pw" => $password, ":txt" => $text, ":rate" => 0));
              }
          }


            $dbVerbindung = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

            $sqlBefehl = $dbVerbindung->prepare('SELECT * FROM blog');
            $sqlBefehl->execute();
            foreach($sqlBefehl->fetchAll() as $x) {
                //var_dump($x);

                echo '<br>ID: ' . $x[0] . '<br />';
                echo 'Username: ' . $x[1] . '<br />';
                echo 'E-Mail: ' . $x[2] . '<br />';
                echo 'Passwort: *******<br />';
                echo 'Text: ' . $x[4] . '<br />';
                echo 'Created: ' . $x[5] . '<br />';
                echo 'Rating: ' . $x[6] . '<br><a href="Blog01.php?fn=ratePlus&id=' . $x[0] . '">+</a>
                <a href="Blog01.php?fn=rateMinus&id=' . $x[0] . '">-</a>
                <br />';
                echo '<hr>';
            }

?>
</body>
</html>
