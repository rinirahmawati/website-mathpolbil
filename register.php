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

// Mengecek apakah form pendaftaran telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form pendaftaran
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengecek apakah username sudah ada
    $sql = "SELECT * FROM daftar WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username sudah ada
        header("Location: login-signup.html?error=username_exists");
        exit();
    } else {
        // Menyimpan data pengguna ke database
        $sql = "INSERT INTO daftar (username, password) VALUES ('$username', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman login dengan pesan sukses
            header("Location: login-signup.html?success=registered");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
