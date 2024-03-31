<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZETECH-WEBSITE</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="position-relative">
    <div class="custom-section container">
      <div class="logos d-flex align-items-center gap-3">
        <img src="logozu.png" alt="Zetech University Logo" width="150" height="auto">
        <a href="#" class="logo fw-bold"><h2>Website Links</h2></a>
      </div>
      <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Info</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Adminlogin.php">Login</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  <main class="container mt-5">
    <div class="row">

      <?php
      require_once 'Connection.php';

      // Retrieve data from the database
      $sql = "SELECT * FROM links";
      $result = $conn->query($sql);

      // Check if the query was successful
      if ($result && $result->num_rows > 0) {
        // Output cards for each row in the result
        $count = 0; // Initialize count variable
        echo "<div class='row'>";
        while ($row = $result->fetch_assoc()) {
          echo "<div class='col-lg-6 col-md-6 mb-4'>"; // Adjusted column classes for two columns
          echo "<div class='card'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'><a href='" . htmlspecialchars($row["url"]) . "'>" . htmlspecialchars($row["title"]) . "</a></h5>";
          echo "<p class='card-text'>" . htmlspecialchars($row["description"]) . "</p>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          $count++;
          if ($count % 2 == 0) {
            echo "</div><div class='row'>"; // Start a new row after every two cards
          }
        }
        echo "</div>"; // Close the last row
      } else {
        // If no links found, display a message
        echo "No links found.";
      }

      // Close the database connection after retrieving data
      $conn->close();
      ?>
    </div>
  </div>
  </main>
  <footer>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-3">
          <div class="quick-links">
            <h2>Quick Links</h2>
            <ul>
              <li><a href="#">Apply Online</a></li>
              <li><a href="#">Staff Portal</a></li>
              <li><a href="#">Blogs</a></li>
              <li><a href="#">Our Partners</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 menu-schools">
          <div class="moduletable_menu">
            <h2>Schools & Institutes</h2>
            <ul class="nav menu mod-list">
              <li class="item-116"><a href="/index.php/school-of-business-economics">School Of Business & Economics</a></li>
              <li class="item-117"><a href="/index.php/school-of-ict-media-engineering">School of ICT, Media & Engineering</a></li>
              <li class="item-118"><a href="/index.php/school-of-education-arts-social-sciences">School of Education, Arts & Social Sciences</a></li>
              <li class="item-127"><a href="/index.php/zu-tvet-centre-zbti">ZU TVET CENTRE (ZBTI)</a></li>
              <li class="item-128"><a href="/index.php/corporate-academy">Corporate Academy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="quick-links">
            <h2>Contact</h2>
            <ul>
              <li>Zetech University,</li>
              <li>Main Campus, Off Thika Road - Ruiru</li>
              <li>P.O. Box 2768 00200, Nairobi.</li>
              <li>Email: info@zetech.ac.ke</li>
              <li>Call: 0719034500 or</li>
              <li>WhatsApp: 0706622557</li>
            </ul></u>
          </div>
        </div>
        <div class="col-md-3">
          <div class="rounded-social-buttons">
            <rel class="social-button facebook" href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></rel>
            <rel class="social-button twitter" href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter"></i></rel>
            <rel class="social-button linkedin" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></rel>
            <rel class="social-button tiktok" href="https://www.tiktok.com/" target="_blank"><i class="fab fa-tiktok"></i></rel>
            <rel class="social-button youtube" href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></rel>
          </div>
        </div>




      </div>
    </div>

  </footer>
  <footer style="margin-top: -20px;">
    <p style="background-color: #cb6015;
              text-align: center;
              font-size: large;
              padding: 20px;
              border: none;
              width: 100%;
              margin: 0 auto; 
              color: #fff;
              overflow-x: hidden; /* Add overflow-x if needed */
              overflow-y: auto; /* Add overflow-y if needed */
              "> &copy; ZU TVET CENTRE (ZBTI) | All Rights Reserved</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>