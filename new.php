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
    if (empty($_POST['name']) || empty($_POST['category_id']) || empty($_POST['price']) || !isset($_FILES['image'])) {
        $errorMessage = "Vul alle verplichte velden in.";
    } else {
        // stap 2: datatypes omzetten en naar variabelen zetten
        $name = trim($_POST['name']);
        $category_id = (int)$_POST['category_id'];
        $price = floatval($_POST['price']);

        $image = $_FILES['image'];
        $imagePath = '';
        if ($image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'img/plants/';
            $imageName = basename($image['name']);
            $targetFilePath = $uploadDir . $imageName;

            if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                $imagePath = $imageName;
            } else {
                $errorMessage = "Fout bij het uploaden van de afbeelding.";
            }
        } else {
            $errorMessage = "Geen afbeelding geüpload of er is een fout opgetreden.";
        }

        if (empty($errorMessage)) {
            // stap 3: INSERT SQL query maken
            $sql = "INSERT INTO plant (name, price, category_id, image) VALUES (:name, :price, :category_id, :image)";

            // stap 4: execute query
            $stmt = $pdo->prepare($sql);
            try {
                $stmt->execute([
                    'name' => $name,
                    'price' => $price,
                    'category_id' => $category_id,
                    'image' => $imagePath
                ]);
                // stap 5: success message
                $successMessage = "Nieuwe plant succesvol toegevoegd!";
            } catch (PDOException $e) {
                $errorMessage = "Fout bij het toevoegen van de plant: " . $e->getMessage();
            }
        }
    }
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
        <?php if ($errorMessage): ?>
            <div class="error-message"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>

        <form method="post" action="new.php" enctype="multipart/form-data">
            <label for="name">Plantnaam:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="price">Prijs:</label><br>
            <input type="number" step="0.01" id="price" name="price" required><br><br>

            <label for="category_id">Categorie:</label><br>
            <select id="category_id" name="category_id" required>
                <option value="">Selecteer een categorie</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category['id']); ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="image">Afbeelding:</label><br>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>

            <button type="submit">Toevoegen</button>
        </form>
        </div>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Plantenkwekerij</p>
        </div>
    </footer>
</body>
</html> 