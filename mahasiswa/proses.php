<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli("localhost", "root", "", "db_latihan");

$action = $_POST['action'] ?? '';

try {
    if ($action == 'simpan') {
        $stmt = $conn->prepare("INSERT INTO tbl_mahasiswa (nim, nama, alamat, Jurusan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $_POST['nim'], $_POST['nama'], $_POST['alamat'], $_POST['Jurusan']);
        $stmt->execute();
        echo "OK: data mahasiswa berhasil disimpan";
    } elseif ($action == 'update') {
        $stmt = $conn->prepare("UPDATE tbl_mahasiswa SET nama = ?, alamat = ?, Jurusan = ? WHERE nim = ?");
        $stmt->bind_param("sssi", $_POST['nama'], $_POST['alamat'], $_POST['Jurusan'], $_POST['nim']);
        $stmt->execute();
        echo "OK: data mahasiswa berhasil diubah";
    } elseif ($action == 'hapus') {
        $stmt = $conn->prepare("DELETE FROM tbl_mahasiswa WHERE nim = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        echo "OK: data mahasiswa berhasil dihapus";
    } else {
        echo "Error: aksi tidak dikenal";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
