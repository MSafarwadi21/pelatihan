<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "", "db_latihan");

$action = $_POST['action'] ?? '';

try {
    if ($action == 'simpan') {
        $stmt = $conn->prepare("INSERT INTO tbl_matkul (kd_matkul, nama, sks) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $_POST['kd_matkul'], $_POST['nama'], $_POST['sks']);
        $stmt->execute();
        echo "OK: data mata kuliah berhasil disimpan";
    } elseif ($action == 'update') {
        $stmt = $conn->prepare("UPDATE tbl_matkul SET nama = ?, sks = ? WHERE kd_matkul = ?");
        $stmt->bind_param("ssi", $_POST['nama'], $_POST['sks'], $_POST['kd_matkul']);
        $stmt->execute();
        echo "OK: data mata kuliah berhasil diubah";
    } elseif ($action == 'hapus') {
        $stmt = $conn->prepare("DELETE FROM tbl_matkul WHERE kd_matkul = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        echo "OK: data mata kuliah berhasil dihapus";
    } else {
        echo "Error: aksi tidak dikenal";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
