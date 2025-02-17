<?php
require_once "data.php";

// les fonctions
function findAllClients()
{
    global $clients;
    $_SESSION['clients'] =$clients;
    return $_SESSION['clients'];
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
        // }else{
        //     echo "Erreur : Le numero de telephone est introuvable";
        //     break;
            }
    }
}
// Ajouter une commande pour un client donné
// function ajouterCommande($tel, $articles) {
//      $clients=findAllClients();
//     foreach ($clients as &$client) {
//         if ($client['telephone'] == $tel) {
//             $nouvelleCommandeId = count($client['commandes']) + 1;
//             $montantTotal = array_sum(array_column($articles, 'montant'));
//             $nouvelleCommande = [
//                 "id" => $nouvelleCommandeId,
//                 "date" => date("Y-m-d"),
//                 "montant" => $montantTotal,
//                 "statut" => "En attente",
//                 "articles" => $articles
//             ];

//             $client['commandes'][] = $nouvelleCommande;

//             return true;
//         }
//     }
//     return false;
// }
// fonction dump die
function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die(); // Arrête l'exécution du script
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
function recupToutLesCommandedes(){
    global $clients;
    $toutesLesCommandes = [];
    foreach ($clients as $client) {
        foreach ($client['commandes'] as $commande) {
            $toutesLesCommandes[] = $commande;
        }
    }

    return $toutesLesCommandes;
} 
