<?php
$conn = new mysqli("localhost", "root", "", "db_latihan");
$result = $conn->query("SELECT j.*, d.nama AS nama_dosen, m.nama AS nama_matkul
                        FROM tbl_jadwal j
                        JOIN tbl_dosen d ON j.kd_dosen = d.kd_dosen
                        JOIN tbl_matkul m ON j.kd_matkul = m.kd_matkul
                        ORDER BY j.id");
$opt_dosen = $conn->query("SELECT * FROM tbl_dosen ORDER BY nama");
$opt_matkul = $conn->query("SELECT * FROM tbl_matkul ORDER BY nama");
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Jadwal</h1>

    <button class="btn btn-primary mb-3 btn-tambah" data-modal="#modalJadwal">Tambah Jadwal</button>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dosen</th>
                            <th>Mata Kuliah</th>
                            <th>Waktu</th>
                            <th>Ruang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['nama_dosen']) ?></td>
                            <td><?= htmlspecialchars($row['nama_matkul']) ?></td>
                            <td><?= htmlspecialchars($row['waktu']) ?></td>
                            <td><?= htmlspecialchars($row['ruang']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit" data-modal="#modalJadwal"
                                    data-values='<?= htmlspecialchars(json_encode($row), ENT_QUOTES) ?>'>Edit</button>
                                <button class="btn btn-danger btn-sm btn-hapus" data-url="jadwal/proses.php"
                                    data-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-list="jadwal/list.php">Hapus</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal form jadwal -->
<div class="modal fade" id="modalJadwal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="crud-form" action="jadwal/proses.php" method="post" data-list="jadwal/list.php">
                <div class="modal-header">
                    <h5 class="modal-title">Form Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="simpan">
                    <input type="hidden" name="id" class="pk" value="">
                    <div class="form-group">
                        <label>Dosen</label>
                        <select class="form-control" name="kd_dosen" required>
                            <option value="">-- pilih dosen --</option>
                            <?php while ($d = $opt_dosen->fetch_assoc()): ?>
                                <option value="<?= $d['kd_dosen'] ?>"><?= htmlspecialchars($d['nama']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mata Kuliah</label>
                        <select class="form-control" name="kd_matkul" required>
                            <option value="">-- pilih mata kuliah --</option>
                            <?php while ($m = $opt_matkul->fetch_assoc()): ?>
                                <option value="<?= $m['kd_matkul'] ?>"><?= htmlspecialchars($m['nama']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input type="text" class="form-control" name="waktu" maxlength="50" placeholder="contoh: 19.00-20.00 WIB">
                    </div>
                    <div class="form-group">
                        <label>Ruang</label>
                        <input type="text" class="form-control" name="ruang" maxlength="50" placeholder="contoh: V. 601">
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
