<?php
require_once "koneksi.php";

$error = "";
$nama = $kontak = $sales = $alamat = $wilayah = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama_penerbit"] ?? "");
    $kontak = trim($_POST["kontak"] ?? "");
    $sales = trim($_POST["sales"] ?? "");
    $alamat = trim($_POST["alamat"] ?? "");
    $wilayah = trim($_POST["wilayah"] ?? "");

    if ($nama === "" || $kontak === "" || $sales === "" || $alamat === "" || $wilayah === "") {
        $error = "Semua kolom wajib diisi.";
    } else {
        $stmt = $conn->prepare("INSERT INTO penerbit (nama_penerbit, kontak, sales, alamat, wilayah) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nama, $kontak, $sales, $alamat, $wilayah);
        $stmt->execute();
        header("Location: index.php?pesan=tambah");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penerbit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container form-container">
    <h1>Tambah Penerbit</h1>
    <?php if ($error): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Nama Penerbit</label>
        <input type="text" name="nama_penerbit" value="<?= htmlspecialchars($nama) ?>" required>

        <label>Kontak</label>
        <input type="text" name="kontak" value="<?= htmlspecialchars($kontak) ?>" required>

        <label>Sales</label>
        <input type="text" name="sales" value="<?= htmlspecialchars($sales) ?>" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3" required><?= htmlspecialchars($alamat) ?></textarea>

        <label>Wilayah</label>
        <input type="text" name="wilayah" value="<?= htmlspecialchars($wilayah) ?>" required>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a class="btn btn-secondary" href="index.php">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
