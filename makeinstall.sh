#!/bin/bash

echo -e "Ce script va vous permettre d'installer une synchronisation entre votre serveur dédié et votre seedbox."
echo ""
echo "Script rsync par 4r3, script d'installation et php par Jedediah, gros merci à ex_rat et à la communauté mondedie.fr !"
echo ""

echo -e "Entrer votre nom d'utilisateur : "
read user
echo ""

echo -e "Entrer le dossier à surveiller sur le serveur (/home/votre_user/torrents/complete/votre_dossier) : "
read folder
echo ""

echo -e "Entrer l'utilisateur SSD du NAS : "
read nasuser
echo ""

echo -e "Entrer l'adresse de votre NAS : "
read nasaddr
echo ""

echo -e "Entrer le dossier de synchro sur le NAS (/volumeX/votre_dossier sur un NAS Synology) : "
read nasfolder
echo ""

echo -e "Entrer la vitesse de synchronisation souhaitée : "
read speed
echo ""

echo -e "Entrer le répertoire d'installation de la page web (/var/www) :"
read folderweb
echo ""

mkdir /home/$user/synchro
cp -R script/* /home/$user/synchro

mkdir $folderweb
cp -R web/* $folderweb

sed -i "s/@user@/$user/g;" /home/$user/synchro/config/user.cfg
sed -i 's#@folder@#'$folder'#' /home/$user/synchro/config/user.cfg
sed -i "s/@nasuser@/$nasuser/g;" /home/$user/synchro/config/user.cfg
sed -i "s/@nasaddr@/$nasaddr/g;" /home/$user/synchro/config/user.cfg
sed -i 's#@nasfolder@#'$nasfolder'#' /home/$user/synchro/config/user.cfg
sed -i "s/@speed@/$speed/g;" /home/$user/synchro/config/user.cfg

sed -i "s/@user@/$user/g;" $folderweb

chmod +x /home/$user/synchro/synchro.sh

#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "#* * * * * cd /home/$user/script/synchro && ./synchro.sh > /dev/null" >> mycron
#install new cron file
crontab mycron
rm mycron

rm -R /tmp/synchro-seedbox

echo ""
echo "Merci, vous pouvez maintenant suivre la suite du tutoriel."
