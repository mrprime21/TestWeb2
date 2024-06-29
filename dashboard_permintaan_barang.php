<?php
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

// Ambil data barang dari database
$sql = "SELECT item_name FROM items";
$result = $conn->query($sql);

if (!$result) {
    die("Query gagal: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Permintaan Barang</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
</head>
<body>
    <div class="container">
        <h2>DASHBOARD PERMINTAAN BARANG</h2>
        <br>
        <form action="staff_database_barang.php" method="get">
            <button type="submit" class="button">Cek Stok Barang</button>
        </form>
        <br>
        <form method="POST" action="proses_permintaan_barang.php">
            <table border="0">
                <tr>
                    <td><label for="tanggal">Tanggal</label></td>
                    <td>: <input type="text" id="tanggal" name="tanggal" placeholder="tanggal-bulan-tahun" required></td>
                </tr>
                <tr>
                    <td><label for="nip">NIP</label></td>
                    <td>: <input type="text" id="nip" name="nip" required></td>
                </tr>
                <tr>
                    <td><label for="item_name">Nama Barang</label></td>
                    <td>:
                        <select id="item_name" name="item_name" required>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['item_name'] . "'>" . $row['item_name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Tidak ada barang tersedia</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="item_quantity">Jumlah</label></td>
                    <td>: <input type="text" id="item_quantity" name="item_quantity" required></td>
                </tr>
                <tr>
                    <td><label>Status</label></td>
                    <td>:
                        <input type="radio" id="belum_ambil" name="status" value="Belum Ambil" checked>
                        <label for="belum_ambil">Belum Ambil</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" class="button" value="Kirim Permintaan"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
