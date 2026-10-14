<?php
require_once "koneksi.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM penerbit WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    header("Location: index.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama_penerbit"] ?? "");
    $kontak = trim($_POST["kontak"] ?? "");
    $sales = trim($_POST["sales"] ?? "");
    $alamat = trim($_POST["alamat"] ?? "");
    $wilayah = trim($_POST["wilayah"] ?? "");

    if ($nama === "" || $kontak === "" || $sales === "" || $alamat === "" || $wilayah === "") {
        $error = "Semua kolom wajib diisi.";
        $data = array_merge($data, [
            "nama_penerbit" => $nama, "kontak" => $kontak,
            "sales" => $sales, "alamat" => $alamat, "wilayah" => $wilayah
        ]);
    } else {
        $stmt = $conn->prepare("UPDATE penerbit SET nama_penerbit=?, kontak=?, sales=?, alamat=?, wilayah=? WHERE id=?");
        $stmt->bind_param("sssssi", $nama, $kontak, $sales, $alamat, $wilayah, $id);
        $stmt->execute();
        header("Location: index.php?pesan=edit");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penerbit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container form-container">
    <h1>Edit Penerbit</h1>
    <?php if ($error): ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
        <label>Nama Penerbit</label>
        <input type="text" name="nama_penerbit" value="<?= htmlspecialchars($data["nama_penerbit"]) ?>" required>

        <label>Kontak</label>
        <input type="text" name="kontak" value="<?= htmlspecialchars($data["kontak"]) ?>" required>

        <label>Sales</label>
        <input type="text" name="sales" value="<?= htmlspecialchars($data["sales"]) ?>" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3" required><?= htmlspecialchars($data["alamat"]) ?></textarea>

        <label>Wilayah</label>
        <input type="text" name="wilayah" value="<?= htmlspecialchars($data["wilayah"]) ?>" required>

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
            <a class="btn btn-secondary" href="index.php">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
