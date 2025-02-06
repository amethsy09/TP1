<?php
require_once "data.php";

// les fonctions
function findAllClients()
{
    return $GLOBALS['clients'];
}
function findClientById($id)
{
    $clients = findAllClients();
    $client = null;
    foreach ($clients as $client) {
        if ($client['id'] == $id) {
            return $client;
        }
    }
    return null;
}

function getClientByTel($tel){
    // $result = [];

    $clients = findAllClients();
    foreach ($clients as $etudiant) {
        if ($etudiant['telephone']== $tel) {
            return $etudiant ;
        }
    }
}



// affichage

function afficherclient($client)
{
    echo "Nom : " . $client["nom"] . "\n";
    echo "Prénom : " . $client["prenom"] . "\n";
    echo "Téléphone : " . $client["telephone"] . "\n";
    echo "---------------------------\n";
}
function afficherclients()
{
    $clients = findAllClients();
    foreach ($clients as $client) {
        afficherclient($client);
    }
}
