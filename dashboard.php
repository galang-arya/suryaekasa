<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    session_start();
    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['username'])) {
        // Jika belum, arahkan ke halaman login
        header("Location: login.php");
        exit();
    }
    ?>

    <!-- Sidebar -->
    <div class="container">
        <nav class="sidebar">
            <div class="innercontainer">
                <p class="heading">Dashboard</p>
            </div>
            <br>
            <ul> 
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="armada.php">Armada</a></li>
                <li><a href="order.php">Order</a></li>
                <li><a href="driver.php">Driver</a></li>
                <li><a href="login.php" onclick="return confirmLogout(event)">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Page -->
        <div class="main-content">
            <h2 id="welcome-message">Halo, <?php echo $_SESSION['username']; ?></h2>
            <p>Ini dashboard</p>
        </div>
    </div>

    <script>
        // Fungsi untuk konfirmasi logout
        function confirmLogout(event) {
            event.preventDefault(); // Mencegah link langsung melakukan redirect
            const userConfirmed = confirm("Logout?");
            if (userConfirmed) {
                // Arahkan ke halaman logout jika user menekan OK
                window.location.href = "login.php";
            }
        }
    </script>
</body>
</html>
