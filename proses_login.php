<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Informasi koneksi database
    $host = "b2gyupwfxhz9wws4cm8x-mysql.services.clever-cloud.com";
    $username = "uib2z9ggrqtqdjti";
    $password = "0DPWF8iJspdFixXahCRc";
    $database = "b2gyupwfxhz9wws4cm8x";
    $port = 3306;

    // Koneksi ke database
    $conn = new mysqli($host, $username, $password, $database, $port);

    // Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

    // Cek username dan password
    $sql = "SELECT * FROM login_akun WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Set session berdasarkan role
            if ($row['role'] == 'admin') {
                $_SESSION['admin_id'] = $row['nip']; // Menggunakan nip sebagai identifier
                header("Location: dashboard_admin.php");
                exit();
            } else if ($row['role'] == 'staff') {
                $_SESSION['staff_id'] = $row['nip']; // Menggunakan nip sebagai identifier
                header("Location: dashboard_permintaan_barang.php");
                exit();
            }
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }

    $conn->close();
}
?>
