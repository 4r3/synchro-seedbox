# nom d'utilisateur linux
user="<user>"

# nom d'utilisateur SSH
user-ssh="<ssh-user>"

# Adresse du NAS
IP="adresse du NAS" 

# emplacement sur le NAS:
dest-NAS="/volumeX/<votre_dossier_de_synchro>"

# Modifier --bwlimit=1024 selon vos envies
ARGS="-aPRL --remove-sent-files --partial-dir=./tmp --temp-dir=./tmp --bwlimit=1024 --rsh=ssh"