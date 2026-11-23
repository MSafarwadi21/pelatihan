<?php
$conn = new mysqli("localhost", "root", "", "db_latihan");
$result = $conn->query("SELECT * FROM tbl_dosen ORDER BY kd_dosen");
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Dosen</h1>

    <button class="btn btn-primary mb-3 btn-tambah" data-modal="#modalDosen">Tambah Dosen</button>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Dosen</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['kd_dosen']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit" data-modal="#modalDosen"
                                    data-values='<?= htmlspecialchars(json_encode($row), ENT_QUOTES) ?>'>Edit</button>
                                <button class="btn btn-danger btn-sm btn-hapus" data-url="dosen/proses.php"
                                    data-id="<?= htmlspecialchars($row['kd_dosen']) ?>"
                                    data-list="dosen/list.php">Hapus</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal form dosen -->
<div class="modal fade" id="modalDosen" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="crud-form" action="dosen/proses.php" method="post" data-list="dosen/list.php">
                <div class="modal-header">
                    <h5 class="modal-title">Form Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="simpan">
                    <div class="form-group">
                        <label>Kode Dosen</label>
                        <input type="number" class="form-control pk" name="kd_dosen" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" maxlength="255">
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
