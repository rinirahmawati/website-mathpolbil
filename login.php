<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root"; // default username untuk XAMPP
$password = ""; // default password untuk XAMPP
$dbname = "user_db"; // nama database

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

// Mengecek apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan username
    $sql = "SELECT * FROM daftar WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mengambil data pengguna
        $row = $result->fetch_assoc();

        // Memeriksa apakah password yang dimasukkan sesuai dengan password di database
        if ($password == $row['password']) {
            // Login berhasil, arahkan pengguna ke halaman utama
            header("Location: kls8.html");
            exit();
        } else {
            $error_message = "Password salah!";
        }
    } else {
        // Username tidak ditemukan
        header("Location: login-signup.html?error=username_not_found");
        exit();
    }

    $conn->close();
}
?>
