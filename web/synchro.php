<!DOCTYPE html>
<html class="">
<head>
<meta charset="UTF-8">
<title>Synchronisation</title>
<link rel=stylesheet type="text/css" href="./style-synchro.css">
</head>

<body>
<?php
$lines = file('./speed.cfg');

// display file line by line
foreach($lines as $line_num => $line) {
    echo htmlspecialchars($line)."<br />\n";
}
?>

<section class="box widget synchro">
	<!-- Titre du bloc !-->
	<header class="header">
		<h2>Synchro</h2>
	</header>
	
	<!-- Informations sur la synchronisation !-->
	<div id="synchro">
		<?php		
			$file='/tmp/synchro'; // On vérifie que le script est lancé
			
			// Remplacer <user> par votre utilisateur linux
			$log='/home/admin/synchro/logs/sending.log';

			if(file_exists($file))
			{
				// On lit le fichier
				$fp=fopen($log,'r');
				$line=fgets($fp,500);
				$titre=$line;

				while(!feof($fp))
				{
					$line2=$line;
					$line=fgets($fp,44);
				}
				fclose($fp);

				// On extrait les informations qui nous intéressent
				$titre=trim($titre);
				$info=stat($titre);

				$taille=$info[7];
				$taille=$taille/1024;
				$taille=$taille/1024;				

				$titre=preg_replace('/^\/.*\//','',$titre);
				$line2=preg_replace('/^[\s]+/','',$line2);
				$info=preg_split('/[\s]+/',$line2);

				$data=$info[0];
				$percentage=$info[1];
				$vitesse=$info[2];
				$eta=$info[3];

				echo $titre; // On affiche le nom du fichier en cours de synchro
				
				// On affiche la barre de progression
				echo "          
				
				<div class=\"ui-progress-bar ui-container transition\" id=\"progress_bar\">
					<div class=\"ui-progress\" style=\"width: $percentage;\">
						<span class=\"ui-label\">$percentage</span>
					</div>
				</div>
				
				";
				
				// On affiche les informations sur la synchronisation
				echo "<div id=\"infosync\">";
				echo "Taille: ";

				if($taille>=999) {
					$taille=$taille/1024;
					echo round($taille, 2);
					echo "Go";
				}

				else {
					echo round($taille, 2);
					echo "Mo";
				}
				echo " | ";
				echo "Vitesse: ";
				echo $vitesse;
				echo "<br>";					
				echo "Temps restant: ";
				echo $eta;
				echo "</div>";

				echo "<a href=\"#\" class=\"info\">Fichiers<span>"; // On affiche le lien qui fera apparaitre la liste des  fichiers
				$file='/tmp/synchro';  // On vérifie que le script est bien lancé
				
				// Remplacer <user> par votre utilisateur linux
				$list='/home/admin/synchro/logs/liste_fichiers';
				
				// On affiche la liste des fichiers dans l'infobulle
				if(file_exists($file))
				{
					$nbcont=0;
					$fp=fopen($list,'r');

					while(!feof($fp))
					{
						$line=fgets($fp,255);
						if (preg_match("/\:+.{0,}/", $line, $matches3))
						{
							$eta = $matches3[0];
							$eta = str_replace(':','',$eta);
							$val = explode('/', $eta);
							$count = count($val);
							$val = $val[$count - 1];
							if(!preg_match('/\.srt$/',$val))
							{
								echo $val;
								echo "<br>";
								$nbcont++;
							}
						}
					}
					fclose($fp);
				}	
				echo "</span>";
				echo " (",$nbcont,")";
				echo "</a><br><br>";
			}
		?>
	</div>
	
</section>

<br>
<br>

<section class="box widget synchro">
	<!-- Titre du bloc !-->
	<header class="header">
		<h2>Speed</h2>
	</header>
	

	

<form action = "synchro.php" method="post">
Vitesse : <input type = "number" name = "speed11" value="256" style="width:50px"><br />

<!-- PO active <input value="checked" type="checkbox" onclick="Change()" name="por" id="choix_1" />

<div id="madiv"  style="visibility:hidden;">
Vitesse PO : <input type = "number" name = "speed2" value="512" style="width:0px">
Début : <input type="time" name="hor1" value="00:00" />
Fin : <input type="time" name="hor2" value="06:00" />
</div> -->


<input type = "submit" value = "Valider"><br>
<br>

<?php
// on teste la déclaration de nos variables
if (isset($_POST['speed11'])) {
	// on affiche nos résultats

	$speed11=$_POST['speed11'];
	$speed2=$_POST['speed2'];
	$hor1=$_POST['hor1'];
	$hor2=$_POST['hor2'];
    $por=$_POST['por'];

	echo $speed11;
	echo "<br>";
	echo $speed2;
	echo "<br>";
	echo $hor1;
	echo "<br>";
	echo $hor2;
	echo "<br>";
	echo $por;
	
	// 1 : on ouvre le fichier
$monfichier = fopen('./speed.cfg', 'w');
 
// 2 : on lit la première ligne du fichier
fputs($monfichier, "speed1=\"$speed11\"\nspeed2=\"$speed2\"\nsp2time1=\"$hor1\"\nsp2time2=\"$hor2\"\n");


	if ($por=='checked') {
        fputs($monfichier, "sp2ena=\"1\"");
	}
	
	else {
        fputs($monfichier, "sp2ena=\"0\"");
	}
	
 
// 3 : quand on a fini de l'utiliser, on ferme le fichier
fclose($monfichier);

}
?>


</section>




<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>

<!-- Actualisation de la synchro toutes les secondes -->
<script type="text/javascript">
	var auto_refresh = setInterval(
	function ()
	{
		$('#synchro').load('./synhro.php #synchro');
	}, 1000); // refresh every 10000 milliseconds
</script>

<!-- PO -->

<script type="text/javascript">
function Change() {

if ((document.getElementById('choix_1').checked)) {
document.getElementById('madiv').style.visibility="visible";
}
else {
document.getElementById('madiv').style.visibility="hidden";
}
}

</script>
</body>
</html>
