<?php
// Database configuration
$host = 'localhost';
$dbname = 'plant_nursery';
$username = 'root';
$password = '';
$charset = 'utf8mb4';

// PDO connection
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch all categories for the dropdown
$stmt = $pdo->query('SELECT * FROM category');
$categories = $stmt->fetchAll();

$errorMessage = "";
$successMessage = "";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // stap 1: bekijk of waarde zijn ingevuld
    // stap 2: datatypes omzetten en naar variabelen zetten
    // stap 3: INSERT SQL query maken
    // stap 4: execute query
    // stap 5: success message
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe plant toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="site-header">
        <div class="container">
            <a href="index.php" class="logo">Plantenkwekerij</a>
            <div class="nav-menu">
                <a href="index.php">Home</a>
                <a href="new.php" class="active">Nieuwe plant</a>
            </div>
        </div>
    </div>
    
    <header>
        <div class="container">
            <a href="index.php" class="back-btn">← Terug naar Categorieën</a>
            <h1>Nieuwe plant toevoegen</h1>
        </div>
    </header>
    
    <main>
        <div class="container">

        <!-- Maak je form hier -->
        </div>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Plantenkwekerij</p>
        </div>
    </footer>
</body>
</html> 