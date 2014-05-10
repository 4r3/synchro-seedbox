#!/bin/bash

function parcours_rep
{
local rep
local rel
local age
local i

if test $# -lt 1
then
rep=$DIR
rel=""
else
rel="$1/"
rep="$DIR$rel"
fi

#echo "dans $rep"

for i in "$rep"*
do
#	read a
	if test -f "$i"
	then

		age=`stat -c %Y "$i"`
		echo "$age:${i//"$DIR/"/}" >> $list
	else
	if test -d "$i"
	then
#		echo "dossier suivant :${i//"$DIR"/}"
#		echo "position relative : $rel"
		parcours_rep "${i//"$DIR"/}"
	fi
	fi
done
rmdir "$rep/"* 2> /dev/null 
#echo "fin $rep"
}

function maj_liste
{
	rm $list 2> /dev/null
	parcours_rep
}

function envois_fichiers
{
patern='*[0-9]:'
patern2='/*'

old_IFS=$IFS
IFS=$'\n'
for line in $(sort $list)
do
	IFS=$old_IFS
	line1=${line##$patern}
#	echo $line1
	fic=${line1##"$DIR"}
#	echo $fic
	rel="${fic%$patern2}/"
#	echo $rel
	envois_fichier "$line1"
	maj_liste
done
IFS=$old_IFS
}


################################
# Debut ce qu il faut modifier #
################################

function envois_fichier
{
#	echo "envoie $1"

	echo "$DIR/$1" > $Log

	# Remplacer par les infos de votre NAS
	rsync $ARGS "$1" <user>@<adresse_de_votre_nas>:/volumeX/<votre_dossier_de_synchro> >> $Log
}




list=/home/<user>/synchro/logs/liste_fichiers

# Dossier des fichiers à transferer
DIR=/home/<user>/torrents/complete/<votre_dossier>

# Modifier --bwlimit=1024 selon vos envies
ARGS="-aPRL --remove-sent-files --partial-dir=./tmp --temp-dir=./tmp --bwlimit=1024 --rsh=ssh"

Log=/home/<user>/synchro/logs/sending.log

#################################
# Fin de ce qu il faut modifier #
################################

if test -f /tmp/synchro
then
	maj_liste
	echo -e "err 3:script deja en execution"
	exit 3
else
	touch /tmp/synchro
fi

cd $DIR
maj_liste

while test -f $list
do
envois_fichiers
done

rm /tmp/synchro
