<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // MySQL Laragon yang berjalan di port 3306.
    // Jika akun root memakai password, isi parameter ketiga.
    $conn = new mysqli("127.0.0.1", "root", "", "crud_penerbit", 3306);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    exit("Koneksi database gagal. Pastikan MySQL berjalan dan database crud_penerbit sudah dibuat.");
}
?>
