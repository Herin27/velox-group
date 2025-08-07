<?php
$con = new mysqli("localhost", "root", "", "velox");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$message = "";

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $heading = $_POST['heading'];
    $subheading = $_POST['subheading'];
    $button_text = $_POST['button_text'];
    $button_url = $_POST['button_url'];
    $stats_text = $_POST['stats_text'];

    // Image upload
    $image_name = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $target_dir = "assets/images/";
    $target_file = $target_dir . basename($image_name);

    if (move_uploaded_file($image_tmp, $target_file)) {
        $sql = "INSERT INTO slider (heading, subheading, button_text, button_url, image_path, stats_text)
                VALUES ('$heading', '$subheading', '$button_text', '$button_url', '$image_name', '$stats_text')";

        if ($con->query($sql)) {
            $message = "Slider saved successfully!";
        } else {
            $message = "Error: " . $con->error;
        }
    } else {
        $message = "Image upload failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Add Slider</title>
    <style>
        body { font-family: Arial; padding: 40px; background: #f4f4f4; }
        form { background: #fff; padding: 30px; border-radius: 8px; width: 600px; margin: auto; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc; }
        button { background: #3B82F6; color: white; padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .msg { text-align: center; margin-bottom: 20px; color: green; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Add / Update Slider</h2>

<?php if ($message): ?>
    <p class="msg"><?= $message ?></p>
<?php endif; ?>

<form action="" method="POST" enctype="multipart/form-data">
    <label>Heading (HTML allowed):</label>
    <input type="text" name="heading" required />

    <label>Subheading:</label>
    <textarea name="subheading" rows="4" required></textarea>

    <label>Button Text:</label>
    <input type="text" name="button_text" required />

    <label>Button URL:</label>
    <input type="text" name="button_url" required />

    <label>Stats Text (e.g., 2.5M+ Daily Transactions):</label>
    <input type="text" name="stats_text" required />

    <label>Slider Image (jpg/png):</label>
    <input type="file" name="image" accept="image/*" required />

    <button type="submit">Save Slider</button>
</form>

</body>
</html>
