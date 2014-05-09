<!DOCTYPE html><html class="">
<head><meta charset="UTF-8">
<title>Synchronisation</title>
<LINK rel=stylesheet type="text/css" href="./style.css">
</head>

<body>
<section class="box widget synchro">
      	<header class="header">
        	<h2>Synchro</h2>
      	</header>


	<div id="synchro">
		<?php
			$file='/tmp/synchro';
			$log='/home/<user>/synchro/logs/sending.log';
			

			if(file_exists($file))
			{
				$fp=fopen($log,'r');
				$line=fgets($fp,500);
				$titre=$line;

				while(!feof($fp))
				{
					$line2=$line;
					$line=fgets($fp,44);
				}
				fclose($fp);
				
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
				

				echo $titre;
				echo "          
				
				<div class=\"ui-progress-bar ui-container transition\" id=\"progress_bar\">
					<div class=\"ui-progress\" style=\"width: $percentage;\">
						<span class=\"ui-label\">$percentage</span>
					</div>
				</div>
				
				";
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
				
				echo "<a href=\"#\" class=\"info\">Fichiers<span>";
				$file='/tmp/synchro';
				$list='/home/<user>/synchro/logs/liste_fichiers';

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
							//echo $eta;
							
							//echo "<br><br>NOM DU FICHIER : ";
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
</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>

<!-- Actualisation de la synchro -->
<script type="text/javascript">
	var auto_refresh = setInterval(
	function ()
	{
		$('#synchro').load('./synchro.php #synchro');
	}, 1000); // refresh every 10000 milliseconds
</script>
</html>
