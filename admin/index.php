<?php
include_once "../../include/config.php";
include_once "../../include/verif_membres.php";
if(isset($_POST['pseudo']) AND isset($_POST['message']) AND !empty($_POST['pseudo']) AND !empty($_POST['message']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$message = htmlspecialchars($_POST['message']);
	$insertmsg = $bdd->prepare('INSERT INTO chat(pseudo, message) VALUES(?, ?)');
	$insertmsg->execute(array($pseudo, $message));
}
?>
<html>
	<head>
		<title>chat advantura</title>
		<meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<style type="text/css">
			#messages img {
				position: relative;
				top: 2px;
			}
		</style>
	</head>
	<body>
		<form method="post" action="">
			<input type="hidden" name="pseudo" placeholder="PSEUDO" value="<?php echo $result['pseudo']; ?>" /><br />
			<textarea type="text" name="message" placeholder="MESSAGE"></textarea><br />
			<input type="submit" value="Envoyer" />
		</form>
		<div id="messages">
			<?php
			$allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC LIMIT 0, 5');
			while($msg = $allmsg->fetch())
			{
				$grade_req = $bdd->prepare('SELECT id FROM chat WHERE pseudo = ?');
				$grade_req->execute(array($msg['pseudo']));
				$grade = $grade_req->rowCount();
				if($grade > 0 AND $grade < 10) {
					$grade = 'Membre junior';
				} elseif($grade >= 10 AND $grade < 50) {
					$grade = 'Membre habitué';
				} else {
					$grade = 'Membre expert';
				}
				$emoji_replace = array(':)',':-)','(angry)',':3',":'(",':|',':(',':-(',';)',';-)');
				$emoji_new = array('<img src="emojis/emo_smile.png" />','<img src="emojis/emo_smile.png" />','<img src="emojis/emo_angry.png" />','<img src="emojis/emo_cat.png" />','<img src="emojis/emo_cry.png" />','<img src="emojis/emo_noreaction.png" />','<img src="emojis/emo_sad.png" />','<img src="emojis/emo_sad.png" />','<img src="emojis/emo_wink.png" />','<img src="emojis/emo_wink.png" />');
				$msg['message'] = str_replace($emoji_replace, $emoji_new, $msg['message']);
			?>
			<b><?php echo $msg['pseudo']; ?></b> (<?= $grade ?>) : <?php echo $msg['message']; ?><br />
			<?php
			}
			?>
		</div>
		<script>
			setInterval('load_messages()', 500);
			function load_messages() {
				$('#messages').load('load_messages.php');
			}
		</script>
	</body>
</html>