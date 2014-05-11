#!/bin/bash

echo -n -e "Ce script va vous permettre de mettre en place une synchronisation entre votre seedbox et votre NAS."
echo ""

echo -n -e "Entrer votre nom d'utilisateur : "
read user

echo -n -e "Entrer le dossier à surveiller sur le serveur : "
read folder

echo -n -e "Entrer l'utilisateur SSD du NAS : "
read nasuser

echo -n -e "Entrer l'adresse de votre NAS : "
read nasaddr

echo -n -e "Entrer le dossier de synchro sur le NAS : "
read nasfolder

echo -n -e "Entrer la vitesse de synchronisation souhaitée : "
read speed

mkdir /home/$user/synchro
cp -R script/* /home/$user/synchro

mkdir /var/www/synchro
cp -R web/* /var/www/synchro

sed -i "s/@user@/$user/g;" /home/$user/synchro/config/user.cfg
sed -i 's#@folder@#'$folder'#' /home/$user/synchro/config/user.cfg
sed -i "s/@nasuser@/$nasuser/g;" /home/$user/synchro/config/user.cfg
sed -i "s/@nasaddr@/$nasaddr/g;" /home/$user/synchro/config/user.cfg
sed -i 's#@nasfolder@#'$nasfolder'#' /home/$user/synchro/config/user.cfg
sed -i "s/@speed@/$speed/g;" /home/$user/synchro/config/user.cfg

sed -i "s/@user@/$user/g;" /var/www/synchro/synchro.php

chmod +x /home/$user/synchro/synchro.sh

#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "#* * * * * cd /home/$user/script/synchro && ./synchro.sh > /dev/null" >> mycron
#install new cron file
crontab mycron
rm mycron
