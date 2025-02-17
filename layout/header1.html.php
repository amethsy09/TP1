<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>commande</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-gray-100 text-gray-800">
<div class="text-center mb-10">
        <h1 class="font-bold text-blue-600 text-4xl">Commandes de <?= htmlspecialchars($client['prenom'] . " " . $client['nom']) ?></h1>
    </div>    
</body>
</html>