<?php
$con = new mysqli("localhost", "root", "", "velox");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TechLeisure - Home</title>
  <link rel="stylesheet" href="./assets/css/style.css" />
</head>
<body>

  <header>
    <div class="navbar">
      <div class="logo">TechLeisure</div>
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Solutions</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <a class="btn" href="#">Get Started</a>
    </div>
  </header>

  <div class="slider-container">
  <?php
  $query = mysqli_query($con, "SELECT * FROM slider");
  while ($row = mysqli_fetch_assoc($query)) {
  ?>
    <div class="slider-card">
      <img src="uploads/<?php echo $row['image']; ?>" alt="Slider Image">
      <div class="slider-content">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['description']; ?></p>
      </div>
    </div>
  <?php } ?>
</div>

</body>
</html>
