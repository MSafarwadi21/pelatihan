<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "", "db_latihan");

$action = $_POST['action'] ?? '';

try {
    if ($action == 'simpan') {
        $stmt = $conn->prepare("INSERT INTO tbl_semester (kd_semester, semester) VALUES (?, ?)");
        $stmt->bind_param("is", $_POST['kd_semester'], $_POST['semester']);
        $stmt->execute();
        echo "OK: data semester berhasil disimpan";
    } elseif ($action == 'update') {
        $stmt = $conn->prepare("UPDATE tbl_semester SET semester = ? WHERE kd_semester = ?");
        $stmt->bind_param("si", $_POST['semester'], $_POST['kd_semester']);
        $stmt->execute();
        echo "OK: data semester berhasil diubah";
    } elseif ($action == 'hapus') {
        $stmt = $conn->prepare("DELETE FROM tbl_semester WHERE kd_semester = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        echo "OK: data semester berhasil dihapus";
    } else {
        echo "Error: aksi tidak dikenal";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
