#!/bin/bash

echo -e "Ce script va vous permettre d'installer une synchronisation\n entre votre serveur dédié et votre seedbox."
echo ""
echo "Script rsync par 4r3, script d'installation et php par Jedediah\n, gros merci à ex_rat et à la communauté mondedie.fr !"
echo ""

#Récupération des informations utilisateur
echo -e "Entrer votre nom d'utilisateur :"
read USER
echo ""

echo -e "Entrer le dossier à surveiller sur le serveur :"
read FOLDER
echo ""

echo -e "Entrer l'utilisateur SSD du NAS :"
read NASUSER
echo ""

echo -e "Entrer l'adresse de votre NAS :"
read NASADDR
echo ""

echo -e "Entrer le dossier de synchro sur le NAS :"
read NASFOLDER
echo ""

echo -e "Entrer la vitesse de synchronisation souhaitée :"
read SPEED
echo ""

echo -e "Entrer le répertoire d'installation de la page web (/var/www) :"
read FOLDERWEB
echo ""

#Création de l'arborescence du script
mkdir /home/$USER/synchro
cp -R script/* /home/$USER/synchro

#Création de l'arborescence de la page web
mkdir $FOLDERWEB
cp -R web/* $FOLDERWEB

#Ecriture des variables dans le fichier de configuration
sed -i "s/@user@/$USER/g;" /home/$USER/synchro/config/user.cfg
sed -i 's#@folder@#'$FOLDER'#' /home/$USER/synchro/config/user.cfg
sed -i "s/@nasuser@/$NASUSER/g;" /home/$USER/synchro/config/user.cfg
sed -i "s/@nasaddr@/$NASADDR/g;" /home/$USER/synchro/config/user.cfg
sed -i 's#@nasfolder@#'$NASFOLDER'#' /home/$USER/synchro/config/user.cfg
sed -i "s/@speed@/$SPEED/g;" /home/$USER/synchro/config/user.cfg

sed -i "s/@user@/$USER/g;" $FOLDERWEB/synchro.php

chmod +x /home/$USER/synchro/synchro.sh

#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "* * * * * cd /home/$USER/synchro && ./synchro.sh > /dev/null" >> mycron
#install new cron file
crontab mycron
rm mycron

#Suppression des fichiers d'installation
rm -R /tmp/synchro-seedbox

echo "Merci, vous pouvez maintenant suivre la suite du tutoriel."
