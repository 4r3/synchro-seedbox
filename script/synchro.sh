#!/bin/bash

#début déclaration des fonctions

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

echo "dans $rep"

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



	while test -f $list
	do

		sort --output=/tmp/liste_temp $list

		line=$(head -1 /tmp/liste_temp)

#		echo $line

		fichier=${line##$patern}

		setspeed

		envois_fichier "$fichier"

		maj_liste

	done
	rm /tmp/liste_temp
}


function envois_fichier
{
#	echo "envoie $1"

	echo "$DIR/$1" > $Log

	rsync $ARGS $BWL "$1" "$user_SSH"@"$IP":"$dest_NAS" >> $Log
}

function setspeed
{
	if test -f $conf_speed
	then
		. $conf_speed

		h=$(date +%s)
		h1=$(date -d "$sp2time1" +%s)
		h2=$(date -d "$sp2time2" +%s)

		if test $sp2ena -eq 1
		then
			if [ $h1 -gt $h2 ]
			then
				if [ $h -lt $h2 ] || [ $h -gt $h1 ]
				then
					speed=$speed2
				else
					speed=$speed1
				fi
			else
				if [ $h -lt $h2 ] && [ $h -gt $h1 ]
				then
					speed=$speed2
				else
					speed=$speed1
				fi
			fi
		else
			speed=$speed1
		fi

		if test speed -lt 1
		then
			BWL=" "
		else
			BWL="--bwlimit=$speed"
		fi
	else
		BWL=" "
	fi
}
#fin déclaration des fonctions


#début script

. ./config/user.cfg

list="/home/$user/synchro/logs/liste_fichiers"

Log="/home/$user/synchro/logs/sending.log"



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


envois_fichiers


rm /tmp/synchro
