<?php
require_once 'config.php';

// Get category ID from URL
$category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// If no valid ID provided, redirect to home page
if ($category_id <= 0) {
    header('Location: index.php');
    exit;
}

// Fetch category information
$stmt = $pdo->prepare('SELECT * FROM category WHERE id = ?');
$stmt->execute([$category_id]);
$category = $stmt->fetch();

// If category not found, redirect to home page
if (!$category) {
    header('Location: index.php');
    exit;
}

// Fetch plants for this category
$stmt = $pdo->prepare('SELECT * FROM plant WHERE category_id = ?');
$stmt->execute([$category_id]);
$plants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category['name']); ?> Plants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="site-header">
        <div class="container">
            <a href="index.php" class="logo">Plant Nursery</a>
            <div class="nav-menu">
                <a href="index.php">Home</a>
                <a href="new.php">Nieuwe plant</a>
            </div>
        </div>
    </div>
    
    <header>
        <div class="container">
            <a href="index.php" class="back-btn">← Back to Categories</a>
            <h1><?php echo htmlspecialchars($category['name']); ?> Plants</h1>
            <div class="category-info">
                <p><?php echo htmlspecialchars($category['description']); ?></p>
            </div>
        </div>
    </header>
    
    <main>
        <div class="container">
            <?php if (count($plants) > 0): ?>
                <div class="plant-list">
                    <?php foreach ($plants as $plant): ?>
                        <div class="plant-card">
                            <img src="img/plants/<?php echo htmlspecialchars($plant['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($plant['name']); ?>">
                            <div class="plant-info">
                                <h2><?php echo htmlspecialchars($plant['name']); ?></h2>
                                <p>Price: €<?php echo number_format($plant['price'], 2); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No plants found in this category.</p>
            <?php endif; ?>
        </div>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Plant Nursery</p>
        </div>
    </footer>
</body>
</html> 