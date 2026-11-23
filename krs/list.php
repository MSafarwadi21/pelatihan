<?php
$conn = new mysqli("localhost", "root", "", "db_latihan");
$result = $conn->query("SELECT k.*, m.nama AS nama_mhs, mk.nama AS nama_matkul, s.semester AS nama_semester
                        FROM tbl_krs k
                        JOIN tbl_mahasiswa m ON k.nim = m.nim
                        JOIN tbl_jadwal j ON k.id_jadwal = j.id
                        JOIN tbl_matkul mk ON j.kd_matkul = mk.kd_matkul
                        JOIN tbl_semester s ON k.kd_semester = s.kd_semester
                        ORDER BY k.id");
$opt_mhs = $conn->query("SELECT * FROM tbl_mahasiswa ORDER BY nama");
$opt_jadwal = $conn->query("SELECT j.id, mk.nama AS nama_matkul, j.waktu, j.ruang
                            FROM tbl_jadwal j JOIN tbl_matkul mk ON j.kd_matkul = mk.kd_matkul
                            ORDER BY j.id");
$opt_semester = $conn->query("SELECT * FROM tbl_semester ORDER BY kd_semester");
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data KRS</h1>

    <button class="btn btn-primary mb-3 btn-tambah" data-modal="#modalKrs">Tambah KRS</button>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIM</th>
                            <th>Mahasiswa</th>
                            <th>Jadwal (ID)</th>
                            <th>Mata Kuliah</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['nim']) ?></td>
                            <td><?= htmlspecialchars($row['nama_mhs']) ?></td>
                            <td><?= htmlspecialchars($row['id_jadwal']) ?></td>
                            <td><?= htmlspecialchars($row['nama_matkul']) ?></td>
                            <td><?= htmlspecialchars($row['nama_semester']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit" data-modal="#modalKrs"
                                    data-values='<?= htmlspecialchars(json_encode($row), ENT_QUOTES) ?>'>Edit</button>
                                <button class="btn btn-danger btn-sm btn-hapus" data-url="krs/proses.php"
                                    data-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-list="krs/list.php">Hapus</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal form KRS -->
<div class="modal fade" id="modalKrs" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="crud-form" action="krs/proses.php" method="post" data-list="krs/list.php">
                <div class="modal-header">
                    <h5 class="modal-title">Form KRS</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="simpan">
                    <input type="hidden" name="id" class="pk" value="">
                    <div class="form-group">
                        <label>Mahasiswa</label>
                        <select class="form-control" name="nim" required>
                            <option value="">-- pilih mahasiswa --</option>
                            <?php while ($m = $opt_mhs->fetch_assoc()): ?>
                                <option value="<?= $m['nim'] ?>"><?= htmlspecialchars($m['nim'] . ' - ' . $m['nama']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jadwal</label>
                        <select class="form-control" name="id_jadwal" required>
                            <option value="">-- pilih jadwal --</option>
                            <?php while ($j = $opt_jadwal->fetch_assoc()): ?>
                                <option value="<?= $j['id'] ?>"><?= htmlspecialchars($j['id'] . ' - ' . $j['nama_matkul'] . ' (' . $j['waktu'] . ', ' . $j['ruang'] . ')') ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select class="form-control" name="kd_semester" required>
                            <option value="">-- pilih semester --</option>
                            <?php while ($s = $opt_semester->fetch_assoc()): ?>
                                <option value="<?= $s['kd_semester'] ?>"><?= htmlspecialchars($s['semester']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
