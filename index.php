<?php
// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "super_compteur_db";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Définir l'encodage de caractères
$conn->set_charset("utf8");

// Démarrer la session
session_start();

// Initialiser le compteur s'il n'est pas encore défini
if (!isset($_SESSION['counter_id'])) {
    // Récupérer ou créer un enregistrement du compteur
    $result = $conn->query("SELECT * FROM compteur LIMIT 1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['counter_id'] = $row['id'];
        $_SESSION['counter_value'] = $row['counter_value'];
    }
}

// Gérer les requêtes AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'increment') {
        $_SESSION['counter_value']++;
    } elseif ($action === 'decrement') {
        $_SESSION['counter_value']--;
    } elseif ($action === 'reset') {
        $_SESSION['counter_value'] = 0;
    }
    
    // Mettre à jour la base de données
    $counter_value = $_SESSION['counter_value'];
    $counter_id = $_SESSION['counter_id'];
    $stmt = $conn->prepare("UPDATE compteur SET counter_value = ? WHERE id = ?");
    $stmt->bind_param("ii", $counter_value, $counter_id);
    $stmt->execute();
    
    echo json_encode(['counter_value' => $counter_value]);
    exit;
}

// Retourner la valeur actuelle du compteur
$current_counter = $_SESSION['counter_value'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le super compteur !</title>
    <link rel="stylesheet" href="style.css" />
    <title>Le super compteur !</title>

</head>

<body>

    <h1 id="compteur">Le superCompteur !</h1>

    <h2 id="message">Calcul</h2>

    <h2 id="total">0</h2>

    <div class="boutons">
        <button id="moins-btn" class="bouton">-</button>
        <button id="plusbtn" class="bouton">+</button>
        <button id="reset" class="bouton">reset</button>
    </div>


    <div class="explications">Ce super compteur vous permet d'incrémenter ou bien de décrementer de 1.</div>
    <script src="script.js"></script>
</body>

</html>