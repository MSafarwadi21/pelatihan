<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "", "db_latihan");

$action = $_POST['action'] ?? '';

try {
    if ($action == 'simpan') {
        // id otomatis (AUTO_INCREMENT), tidak perlu diisi
        $stmt = $conn->prepare("INSERT INTO tbl_krs (nim, id_jadwal, kd_semester) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $_POST['nim'], $_POST['id_jadwal'], $_POST['kd_semester']);
        $stmt->execute();
        echo "OK: data KRS berhasil disimpan";
    } elseif ($action == 'update') {
        $stmt = $conn->prepare("UPDATE tbl_krs SET nim = ?, id_jadwal = ?, kd_semester = ? WHERE id = ?");
        $stmt->bind_param("iiii", $_POST['nim'], $_POST['id_jadwal'], $_POST['kd_semester'], $_POST['id']);
        $stmt->execute();
        echo "OK: data KRS berhasil diubah";
    } elseif ($action == 'hapus') {
        $stmt = $conn->prepare("DELETE FROM tbl_krs WHERE id = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        echo "OK: data KRS berhasil dihapus";
    } else {
        echo "Error: aksi tidak dikenal";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
