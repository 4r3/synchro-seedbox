<!DOCTYPE html><html class="">
<head><meta charset="UTF-8">
<title>Synchronisation</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>

	<!-- Actualisation de la synchro -->
	<script type="text/javascript">
		var auto_refresh = setInterval(
		function ()
		{
			$('#synchro').load('./synchro.php #synchro');
		}, 1000); // refresh every 10000 milliseconds
	</script>
	
<style>
body {
  font-family: 'Open Sans', sans-serif;
  background: #ebebeb;
  padding-top: 20px;
}

.box {
  background: #f9f9f9;
  box-shadow: 0 0 1px rgba(0, 0, 0, 0.2), 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  margin-bottom: 20px;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
  width:500px;
  margin:auto;
}
.box h2 {
  color: #dd5555;
  font-size: 1em;
}

.synchro {
  text-align: center;
}
.synchro .header {
  padding: 10px 0;
}


a {
	text-decoration:none;
	font-size:10px;
	color: #7d7d7d;
	line-height:5px;
}

.bloc-head {
	color: #dd5555;
	font-size: 0.875em;
    padding-left:0px;
    padding-top:10px;
}

.bloc{
	margin-left:10px;
	line-height:15px;
	padding-bottom:10px;
}


/*
Copyright (c) 2010-2012 Ivan Vanderbyl
Originally found at http://ivan.ly/ui
*/


/* Bar which is placed behind the progress */
.ui-progress-bar {

  /* Usual setup stuff */
  position: relative;
  height: 23px;

  margin-top:5px;
  margin-bottom:5px;
  /* Pad right so we don't cover the borders when fully progressed */

  /* For browser that don't support gradients, we'll set a blanket background colour */
  background-color: rgba(0, 0, 0, .15);
  /* Rounds the ends, we specify an excessive amount to make sure they are completely rounded */
  /* Adjust to your liking, and don't forget to adjust to the same amount in .ui-progress */
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  -o-border-radius: 5px;
  -ms-border-radius: 5px;
  -khtml-border-radius: 5px;
  border-radius: 5px;
  /* Background gradient */
 
  /* Give it the inset look by adding some shadows and highlights */

  /* Alt colours */
  /* Progress part of the progress bar */
}
.ui-progress-bar.blue .ui-progress {
  background-color: #339BB9!important;
  border: 1px solid #287a91;
}
.ui-progress-bar.error .ui-progress {
  background-color: #C43C35 !important;
  border: 1px solid #9c302a;
}
.ui-progress-bar.warning .ui-progress {
  background-color: #D9B31A!important;
  border: 1px solid #ab8d15;
}
.ui-progress-bar.success .ui-progress {
  background-color: #57A957!important;
  border: 1px solid #458845;
}
.ui-progress-bar.transition .ui-progress {
  -moz-transition: background-color 0.5s ease-in, border-color 1.5s ease-out, box-shadow 1.5s ease-out;
  -webkit-transition: background-color 0.5s ease-in, border-color 1.5s ease-out, box-shadow 1.5s ease-out;
  -o-transition: background-color 0.5s ease-in, border-color 1.5s ease-out, box-shadow 1.5s ease-out;
  transition: background-color 0.5s ease-in, border-color 1.5s ease-out, box-shadow 1.5s ease-out;
}
.ui-progress-bar .ui-progress {
  /* Usual setup stuff */
  position: relative;
  display: block;
  overflow: hidden;
  /* Height should be 2px less than .ui-progress-bar so as to not cover borders and give it a look of being inset */
  height: 23px;
  /* Rounds the ends, we specify an excessive amount to make sure they are completely rounded */
  /* Adjust to your liking, and don't forget to adjust to the same amount in .ui-progress-bar */
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  -o-border-radius: 5px;
  -ms-border-radius: 5px;
  -khtml-border-radius: 5px;
  border-radius: 5px;
  /* Set the background size so the stripes work correctly */
  -webkit-background-size: 44px 44px;
  -moz-background-size: 36px 36px;
  /* Webkit */
  /* For browser that don't support gradients, we'll set a base background colour */
  background-color: #dd5555;


  /* Give it a higher contrast outline */

 
  /* Style status label */
}
.ui-progress-bar .ui-progress span.ui-label {
  -moz-font-smoothing: antialiased;
  -webkit-font-smoothing: antialiased;
  -o-font-smoothing: antialiased;
  -ms-font-smoothing: antialiased;
  -khtml-font-smoothing: antialiased;
  font-smoothing: antialiased;
  font-size: 13px;
  position: absolute;
  right: 0;
  line-height: 23px;
  padding-right: 12px;
  color: rgba(0, 0, 0, 0.6);
  text-shadow: rgba(255, 255, 255, 0.45) 0 1px 0px;
  white-space: nowrap;
}
.ui-progress-bar .ui-progress span.ui-label b {
  font-weight: bold;

}


/* INFOBULLE */
a.info {
   position: relative;
   color: grey;
   text-decoration: none;
   border-bottom: 1px gray dotted; /* On souligne le texte. */
   font-size: 8pt;
}
a.info span {
   display: none; /* On masque l'infobulle. */
}
a.info:hover {
   background: none; /* Correction d'un bug d'Internet Explorer. */
   z-index: 500; /* On définit une valeur pour l'ordre d'affichage. */

   cursor: help; /* On change le curseur par défaut par un curseur d'aide. */
}
a.info:hover span {
   display: inline; /* On affiche l'infobulle. */
   position: absolute;

   white-space: nowrap; /* On change la valeur de la propriété white-space pour qu'il n'y ait pas de retour à la ligne non désiré. */

   bottom: 30px; /* On positionne notre infobulle. */


   background: grey;

   color: white;
   padding: 3px;

   font-size: 8pt;
   border-radius: 10px;
   
    padding: 0.5em;
    border-radius: 10px;
	background: rgba(0, 0, 0, .75);
	box-shadow: 1px 1px 12px #000;
	border-spacing : 50px;
	line-height:12px;
}	

/* Texte, barre */
#synchro {
	text-align:center;
	word-wrap:break-word;
	font-size:12px;
	width:450px;
	margin:auto;
	
}

#infosync {
	font-size:10px;
	color: #7d7d7d;
}


</style>
</head>

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
</html>