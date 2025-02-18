<?php
require_once 'recruitment_system/db.php'; // Include database connection

// Fetch all images from the gallery table
$stmt = $conn->prepare("SELECT id, image_path, description FROM gallery ORDER BY id DESC");
$stmt->execute();
$stmt->bind_result($id, $image_path, $description);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment System - Image Gallery</title>
    <link rel="stylesheet" href="recruitment_system/assets/css/styles.css">
    <style>
        /* Gallery Section Styling */
        .gallery-section {
            text-align: center;
            padding: 20px;
         
        }
        
        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .gallery-item {
            width: 200px;
            text-align: center;
        }

        .gallery-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .gallery-item p {
            margin-top: 5px;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>
<body>
<section class="gallery-section">
    <h2>Image Gallery</h2>
    <div class="gallery-container">
        <?php
        // Display the images
        while ($stmt->fetch()) {
            echo '<div class="gallery-item">';
            $image_full_path = 'recruitment_system/' . $image_path; // Adjust path if needed
            if (file_exists($image_full_path)) {
                echo '<img src="' . htmlspecialchars($image_full_path) . '" alt="Gallery Image">';
            } else {
                echo '<p>Image not found: ' . htmlspecialchars($image_full_path) . '</p>';
            }
            
            
            echo '</div>';
        }

        $stmt->close();
        ?>
    </div>
</section>

<?php include 'recruitment_system/includes/footer.php'; ?>
</body>
</html>
