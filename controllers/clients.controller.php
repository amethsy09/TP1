<?php
require_once "../model.php";
require_once "../lib/utile.php";

// Traitement de la recherche par téléphone
if (isset($_GET['tel'])) {
    $tel = ($_GET['tel']);
    $clientListe = getClientByTel($tel);
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == "liste") {
        $clients = findAllClients();
        $currentPage = isset($_GET['view']) ? (int) $_GET['view'] : 2;
        $nbrElement = 3;
        $clientListe = lister_par_page($clients, $currentPage, $nbrElement);
        $nbrPage = recup_nbrdepage($clients, 3);
        require_once "../views/list.client.html.php";
    } elseif ($page == "detail") {
        $clientId = isset($_GET['client_id']) ? (int)$_GET['client_id'] : null;

        if ($clientId) {
            $client = findClientById($clientId);

            if ($client) {
                require_once "../views/list.detail.html.php";
            } else {
                echo "Client non trouvé.";
                exit;
            }
        } else {
            echo "ID de client manquant.";
            exit;
        }
    }
} else {
    require_once "../views/list.client.html.php";
}
