<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "", "db_latihan");

$action = $_POST['action'] ?? '';

try {
    if ($action == 'simpan') {
        // id otomatis (AUTO_INCREMENT), tidak perlu diisi
        $stmt = $conn->prepare("INSERT INTO tbl_jadwal (kd_dosen, kd_matkul, waktu, ruang) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $_POST['kd_dosen'], $_POST['kd_matkul'], $_POST['waktu'], $_POST['ruang']);
        $stmt->execute();
        echo "OK: data jadwal berhasil disimpan";
    } elseif ($action == 'update') {
        $stmt = $conn->prepare("UPDATE tbl_jadwal SET kd_dosen = ?, kd_matkul = ?, waktu = ?, ruang = ? WHERE id = ?");
        $stmt->bind_param("iissi", $_POST['kd_dosen'], $_POST['kd_matkul'], $_POST['waktu'], $_POST['ruang'], $_POST['id']);
        $stmt->execute();
        echo "OK: data jadwal berhasil diubah";
    } elseif ($action == 'hapus') {
        $stmt = $conn->prepare("DELETE FROM tbl_jadwal WHERE id = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        echo "OK: data jadwal berhasil dihapus";
    } else {
        echo "Error: aksi tidak dikenal";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
