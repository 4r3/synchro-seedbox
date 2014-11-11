#!/bin/bash
#
# Synchro-Seedbox
# Auteur: Script rsync par 4r3, script d'installation et php par Jedediah
#
# Installation :
# cd /tmp
# git clone https://github.com/4r3/synchro-seedbox
# cd synchro-seedbox
# chmod +x makeinstall.sh
#./makeinstall.sh
#

# variables couleurs
CSI="\033["
CEND="${CSI}0m"
CRED="${CSI}1;31m"
CGREEN="${CSI}1;32m"
CYELLOW="${CSI}1;33m"
CBLUE="${CSI}1;34m"

clear

# contrôle droits utilisateur
if [ $(id -u) -ne 0 ]
	then
		echo ""
		echo -e "${CRED}Ce script doit être exécuté en root.$CEND" 1>&2
		echo ""
		exit 1
	fi

# logo
echo ""
echo -e "${CBLUE}                                Synchro-Seedbox$CEND"
echo ""
echo -e "${CBLUE}
                                      |          |_)         _|     
            __ \`__ \   _ \  __ \   _\` |  _ \  _\` | |  _ \   |    __|
            |   |   | (   | |   | (   |  __/ (   | |  __/   __| |   
           _|  _|  _|\___/ _|  _|\__,_|\___|\__,_|_|\___|_)_|  _|   

$CEND"
echo ""
echo -e "${CYELLOW}          Ce script va vous permettre d'installer une synchronisation$CEND"
echo -e "${CYELLOW}            automatique entre votre serveur dédié et votre seedbox.$CEND"
echo ""
echo -e "${CBLUE}        Script rsync par 4r3, script d'installation et php par Jedediah.$CEND"
echo -e "${CBLUE}              Gros merci à ex_rat et à la communauté mondedie.fr !$CEND"
echo ""

#Récupération des informations utilisateur
echo ""
echo -e "${CGREEN}Entrer votre nom d'utilisateur:$CEND"
read USER
echo ""

echo -e "${CGREEN}Entrer le dossier à surveiller sur le serveur\n(/home/user/torrents/complete/dossier):$CEND"
read FOLDER
echo ""

echo -e "${CGREEN}Entrer l'utilisateur SSH du NAS:$CEND"
read NASUSER
echo ""

echo -e "${CGREEN}Entrer l'adresse de votre NAS:$CEND"
read NASADDR
echo ""

echo -e "${CGREEN}Entrer le port SSH du NAS (si vous ne savez pas, tapez 22):$CEND"
read NASPORT
echo ""

echo -e "${CGREEN}Entrer le dossier de synchro sur le NAS\n(/volumeX/dossier sur NAS Synology):$CEND"
read NASFOLDER
echo ""

echo -e "${CGREEN}Entrer la vitesse de la synchro:$CEND"
read SPEED
echo ""

#Création de l'arborescence du script
mkdir /home/$USER/synchro
cp -R script/* /home/$USER/synchro

#Création de l'arborescence de la page web
mkdir /var/www/syncnas
cp -R web/* /var/www/syncnas
chown -R www-data /var/www/syncnas

#Ecriture des variables dans le fichier de configuration
sed -i "s/@user@/$USER/g;" /home/$USER/synchro/config/user.cfg
sed -i 's#@folder@#'$FOLDER'#' /home/$USER/synchro/config/user.cfg
sed -i "s/@nasuser@/$NASUSER/g;" /home/$USER/synchro/config/user.cfg
sed -i "s/@nasaddr@/$NASADDR/g;" /home/$USER/synchro/config/user.cfg
sed -i 's#@nasfolder@#'$NASFOLDER'#' /home/$USER/synchro/config/user.cfg
sed -i 's#@port@#'$NASPORT'#' /home/$USER/synchro/config/user.cfg
sed -i "s/@speed@/$SPEED/g;" /home/$USER/synchro/config/user.cfg
#sed -i 's#@folderweb@#'$FOLDERWEB'#' /home/$USER/synchro/config/user.cfg

sed -i "s/@user@/$USER/g;" /var/www/syncnas/index.php

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

echo ""
echo "${CBLUE}Merci, vous pouvez maintenant suivre la suite du tutoriel.$CEND"
echo ""
