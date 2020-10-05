<?php
include "../verif/config.php";
include "../verif/verif_membres.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>chat Magicradio</title>
  <link rel="stylesheet" href="app.css">
</head>
<body>
  <header>
<p><a href = "../../index.php">Retournez à l'accueil.</a></p>
    <h1>Chat</h1>
  </header>
    <section class="chat">
    <div class="messages">
     
    </div>
    <div class="user-inputs">
      <form action="handler.php?task=write" method="POST">
        <input type="hidden" name="author" id="author" value=<?php echo $result['pseudo']; ?>">
        <input type="text" id="content" name="content" placeholder="saisit ton message">
        <button type="submit">Shoote!</button>
      </form>
    </div>
  </section>
  <script src="app.js"></script>
</body>
</html>