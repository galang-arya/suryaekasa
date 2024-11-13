<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "suryaekasa";

// Koneksi ke database
$mysqliconnect = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$mysqliconnect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Cek jika pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Cek jika form tambah driver disubmit
if (isset($_POST['submit_driver'])) {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $domisili = $_POST['domisili'];
    $umur = $_POST['umur'];

    // Query untuk menambahkan data driver
    $query = "INSERT INTO drivers (nama, nik, domisili, umur) VALUES ('$nama', '$nik', '$domisili', '$umur')";
    
    // Eksekusi query
    if (mysqli_query($mysqliconnect, $query)) {
        echo "Driver berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqliconnect);
    }
}

// Cek jika ada parameter 'hapus_driver'
if (isset($_GET['hapus_driver'])) {
    $id_driver = $_GET['hapus_driver'];

    // Query untuk menghapus data driver berdasarkan ID
    $query = "DELETE FROM drivers WHERE id = '$id_driver'";

    // Eksekusi query
    if (mysqli_query($mysqliconnect, $query)) {
        echo "Driver berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqliconnect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="innercontainer">
                <p class="heading">Driver</p>
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

        <div class="main-content">
            <h2>Halo, <?php echo $_SESSION['username']; ?></h2>

            <h3>Tambah Driver</h3>
            <form method="POST" action="">
                <label for="nama">Nama Driver:</label>
                <input type="text" id="nama" name="nama" required>
                
                <label for="nik">NIK:</label>
                <input type="text" id="nik" name="nik" required>
                
                <label for="domisili">Domisili:</label>
                <input type="text" id="domisili" name="domisili" required>
                
                <label for="umur">Umur:</label>
                <input type="number" id="umur" name="umur" required>
                
                <input type="submit" name="submit_driver" value="Tambah Driver">
            </form>

            <p class="pheader">Daftar Driver</p>
            <table border="1">
                <thead>
                    <tr>
                        <th>Nama Driver</th>
                        <th>NIK</th>
                        <th>Domisili</th>
                        <th>Umur</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil data driver dari tabel 'drivers'
                    $query = "SELECT id, nama, nik, domisili, umur FROM drivers";
                    $result = mysqli_query($mysqliconnect, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['nama']}</td>
                                <td>{$row['nik']}</td>
                                <td>{$row['domisili']}</td>
                                <td>{$row['umur']}</td>
                                <td><a href='?hapus_driver={$row['id']}'>Hapus</a></td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data driver.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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
