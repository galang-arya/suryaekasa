<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <center>
        <p class="heading">PT.Surya Ekasa</p>
        <form method="post" action="">
            <table>
                <tr>
                    <th colspan="2">LOGIN</th>
                </tr>
                <tr>
                    <td><label>* Nama : </label></td>
                    <td><input type="text" name="username" placeholder="Masukkan nama" required></td>
                </tr>
                <tr>
                    <td><label>* Password : </label></td>
                    <td><input type="password" name="password" placeholder="Masukkan Password" required></td>
                </tr>
                <tr>
                    <td><input class="button" type="submit" name="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
    </center>

    <?php
    // Cek jika tombol submit ditekan
    if (isset($_POST['submit'])) {
        // Menghubungkan ke database
        $servername = "localhost";
        $username = "root"; // ganti dengan username database Anda jika berbeda
        $password = ""; // ganti dengan password database Anda jika ada
        $dbname = "suryaekasa";

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Mengambil data dari form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Mencegah SQL Injection
        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);

        // Query untuk memeriksa username dan password
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Login berhasil, redirect ke dashboard
            session_start();
            $_SESSION['username'] = $username;
            echo "<script>window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<p style='color:red;'>Login gagal: Username atau Password salah</p>";
        }

        // Menutup koneksi
        $conn->close();
    }
    ?>
</body>
</html>
