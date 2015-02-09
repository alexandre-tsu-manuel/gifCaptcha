<?php
	session_start();
	if (isset($_POST["captcha"]))
		if (strtoupper($_POST["captcha"]) == $_SESSION["captcha"])
			$correctCaptcha = 1;
		else
			$correctCaptcha = 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Captcha</title>
	</head>
	<body>
		<img src="captcha.php" alt="captcha" />
		<?php
			if(isset($correctCaptcha))
			{
				if ($correctCaptcha)
					echo '<p style="color: green">Captcha correct</p>';
				else
					echo '<p style="color: red">Captcha incorrect</p>';
			}
		?>
		<form method="post">
			<p>
				<label for="captcha">Recopiez le texte ici : </label>
				<input type="text" name="captcha" id="captcha" />
				<br />
				<input type="submit" value="Tester" />
			</p>
		</form>
	</body>
</html>