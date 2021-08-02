## Ajout d'une validation pour le numeros de tel

Créer section "Validation Form" dans la Tab Customer deja existante
Créer group Fields
- Regex parametrable dans le BO
- Surcharger le layout du formulaire d'incription pour afficher les champs addresses du customer
- Surcharger le template(widget telephone)
- postcode ?

Comment appliquer le php config dans le custom js validation ?
Surcharger le block widget par plugin ou preference
Passer la regex via data-validate='{"validate-jkelle-phone":toto, "regex":ok}'


Tout OK sinon bien réécrire le readme.

A faire:
Activer le debug
La creation de compte customer ne se fais pas
continuer avec le code postal
ajout attribut customer
corriger le probleme du module cmsBlock
tester un plugin au lieu de la preference
envoyer un mail 
Upload pdf, csv dans media dans un system/config


System.xml:
extends une section existante
trad ? config_path, validate est ce le meme que celui de validate-jkelle-phone

ACL:
Dés qu'on fait une nouvelle section, il faut un fichier acl.xml dans etc/
OU dés qu'on fait un controller avec un menu

