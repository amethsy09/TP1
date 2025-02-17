<?php
// fonction de redirection

function redirect($controller, $page) {
    if (defined('WEBROOT')) {
        header('Location: ' . WEBROOT . '?controller=' .($controller) . '&page='.($page));
        exit;
    } else {
        echo "Erreur : La constante WEBROOT n'est pas définie.";
    }
}
