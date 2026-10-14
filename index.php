<?php
require_once "koneksi.php";
$result = $conn->query("SELECT * FROM penerbit ORDER BY id DESC");
$pesan = $_GET["pesan"] ?? "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Penerbit & Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Manajemen Penerbit &amp; Supplier</h1>
    <h2>Data Penerbit</h2>

    <?php if ($pesan === "tambah"): ?>
        <div class="alert">Data penerbit berhasil ditambahkan.</div>
    <?php elseif ($pesan === "edit"): ?>
        <div class="alert">Data penerbit berhasil diperbarui.</div>
    <?php elseif ($pesan === "hapus"): ?>
        <div class="alert">Data penerbit berhasil dihapus.</div>
    <?php endif; ?>

    <a class="btn btn-primary" href="tambah.php">+ Tambah Penerbit</a>

    <div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No</th><th>Nama Penerbit</th><th>Kontak</th>
                <th>Sales</th><th>Alamat</th><th>Wilayah</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row["nama_penerbit"]) ?></td>
                <td><?= htmlspecialchars($row["kontak"]) ?></td>
                <td><?= htmlspecialchars($row["sales"]) ?></td>
                <td><?= htmlspecialchars($row["alamat"]) ?></td>
                <td><?= htmlspecialchars($row["wilayah"]) ?></td>
                <td class="actions">
                    <a class="btn btn-edit" href="edit.php?id=<?= (int)$row["id"] ?>">Edit</a>
                    <form action="hapus.php" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        <input type="hidden" name="id" value="<?= (int)$row["id"] ?>">
                        <button class="btn btn-delete" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7" class="empty">Belum ada data penerbit. Klik “Tambah Penerbit” untuk mulai.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>
