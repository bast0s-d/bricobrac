<?php



/**
 *
 *
 * @param array $donnees le champs de formulaire a vérifier
 * @param array $regles un tableau contenant les règles à vérifier
 *
 * liste des donnees:
 *  -
 *
 * liste des règles :
 *  - obligatoire
 *  - numerique
 *  - email
 *  - min:8
 *
 *
 *
 */

function checkfield($donnees, $regles){
    foreach ($regles as $champs => $regle){
        if(in_array('obligatoire', $regle)){
            if(!isset($donnees[$champs])){
                return ['message' => 'le champs ' . $champs .' est obligatoire', 'succes' => false];
            }
        }
        if(in_array('numerique', $regle)){
            if(!is_numeric($donnees[$champs])){
                return ['message' => 'le champs ' . $champs .' n\'est pas un nombre ', 'succes' => false];
            }
        }
    }
    return ['message' => 'OK', 'succes' => true];
}