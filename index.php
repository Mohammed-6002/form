<?php
require_once 'config.php';

// Fetch all categories
$stmt = $pdo->query('SELECT * FROM category');
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Categories</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="site-header">
        <div class="container">
            <a href="index.php" class="logo">Plant Nursery</a>
            <div class="nav-menu">
                <a href="index.php" class="active">Home</a>
                <a href="new.php">Nieuwe plant</a>
            </div>
        </div>
    </div>
    
    <header>
        <div class="container">
            <h1>Plant categorieën</h1>
        </div>
    </header>
    
    <main>
        <div class="container">
            <div class="category-list">
                <?php foreach ($categories as $category): ?>
                    <div class="category-card">
                        <div class="category-info">
                            <h2><?php echo htmlspecialchars($category['name']); ?></h2>
                            <p><?php echo htmlspecialchars($category['description']); ?></p>
                            <p><a href="category.php?id=<?php echo $category['id']; ?>">Bekijk planten</a></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    
    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Plant Nursery</p>
        </div>
    </footer>
</body>
</html> 