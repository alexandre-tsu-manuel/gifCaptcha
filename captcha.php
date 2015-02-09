<?php
	session_start();
	include("GIFEncoder.class.php"); //la classe qui se charge de l'encodage du gif

	function cara_aleatoire($longueur)
	{ //fonction qui genere une chaine aleatoire de la longueur voulue
		$retour = "";
		$chaine = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
		for($i=0; $i<$longueur; $i++)
			$retour .= $chaine[mt_rand(0,strlen($chaine)-1)];
		return $retour;
	}
	$captcha_largeur = 220;
	$captcha_hauteur = 100;
	$longueur_texte = 6;
	$police = 'ariblk.ttf';
	$taille_texte = mt_rand(25,35);
	$angle_texte = mt_rand(-10,10);
	$nb_trait = 500;
	$duree_image = 3; //milliseconde
	$nb_image = 10; //nombre de frames du gif
	 
	// Declaration des couleurs
	$image = imagecreatetruecolor($captcha_largeur, $captcha_hauteur);
	$blanc = imagecolorallocate($image, 255, 255, 255);
	$blanc_alpha = imagecolorallocatealpha($image, 255, 255, 255, 50);
	$noir = imagecolorallocate($image, 0, 0, 0);
	$noir_alpha = imagecolorallocatealpha($image, 0, 0, 0, 50);
	$_SESSION["captcha"] = $texte = cara_aleatoire($longueur_texte);
	 
	$coord = imagettfbbox($taille_texte, $angle_texte, $police, $texte);
	$zone_abscisse = $captcha_largeur-$coord[2];
	$position_x_texte = 5;
	$position_y_texte = 65;
	 
	for($j = 0; $j<$nb_image; $j++)
	{ //pour chacune des images constituant le gif
		imagefilledrectangle($image, 0, 0, $captcha_largeur, $captcha_hauteur, $noir);
	
		//Trace des lignes blanches
		for($i = 0; $i<$nb_trait; $i++)
		{
			$x = mt_rand(0, $captcha_largeur-2);
			$y = mt_rand(0, $captcha_hauteur);
			$longueur = mt_rand(1,10);
			imageline($image, $x, $y, $x+$longueur, $y, $blanc);
			
			$x = mt_rand(0, $captcha_largeur);
			$y = mt_rand(0, $captcha_hauteur-2);
			$hauteur = mt_rand(1,10);
			imageline($image, $x, $y, $x, $y+$hauteur, $blanc);
		}
	 
		//Affichage du texte
		imagettftext($image, $taille_texte, $angle_texte, $position_x_texte, $position_y_texte, $blanc, $police, $texte);
	 
		//Trace des lignes noires
		for($k = 0; $k<$nb_trait; $k++)
		{
			$x = mt_rand(0, $captcha_largeur-2);
			$y = mt_rand(0, $captcha_hauteur);
			$longueur = mt_rand(1,10);
			
			imageline($image, $x, $y, $x+$longueur, $y, $noir);
			
			$x = mt_rand(0, $captcha_largeur);
			$y = mt_rand(0, $captcha_hauteur-2);
			$hauteur = mt_rand(1,10);
			
			imageline($image, $x, $y, $x, $y+$hauteur, $noir);
		}
		
		ob_start();
		imagegif($image);
		$images[] = ob_get_clean();
		$temps[] = $duree_image;
	}
	$gif = new GIFEncoder($images, $temps, 0, 2, 0, 0, 0, "bin"); //encodage du gif*/
	
	header('Content-Type: image/gif');
	echo $gif->GetAnimation();
?>