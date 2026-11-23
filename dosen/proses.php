<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "", "db_latihan");

$action = $_POST['action'] ?? '';

try {
    if ($action == 'simpan') {
        $stmt = $conn->prepare("INSERT INTO tbl_dosen (kd_dosen, nama, alamat) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $_POST['kd_dosen'], $_POST['nama'], $_POST['alamat']);
        $stmt->execute();
        echo "OK: data dosen berhasil disimpan";
    } elseif ($action == 'update') {
        $stmt = $conn->prepare("UPDATE tbl_dosen SET nama = ?, alamat = ? WHERE kd_dosen = ?");
        $stmt->bind_param("ssi", $_POST['nama'], $_POST['alamat'], $_POST['kd_dosen']);
        $stmt->execute();
        echo "OK: data dosen berhasil diubah";
    } elseif ($action == 'hapus') {
        $stmt = $conn->prepare("DELETE FROM tbl_dosen WHERE kd_dosen = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        echo "OK: data dosen berhasil dihapus";
    } else {
        echo "Error: aksi tidak dikenal";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
