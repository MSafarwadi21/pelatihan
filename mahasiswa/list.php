<?php
$conn = new mysqli("localhost", "root", "", "db_latihan");
$result = $conn->query("SELECT * FROM tbl_mahasiswa ORDER BY nim");
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Mahasiswa</h1>

    <button class="btn btn-primary mb-3 btn-tambah" data-modal="#modalMhs">Tambah Mahasiswa</button>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nim']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= htmlspecialchars($row['Jurusan']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit" data-modal="#modalMhs"
                                    data-values='<?= htmlspecialchars(json_encode($row), ENT_QUOTES) ?>'>Edit</button>
                                <button class="btn btn-danger btn-sm btn-hapus" data-url="mahasiswa/proses.php"
                                    data-id="<?= htmlspecialchars($row['nim']) ?>"
                                    data-list="mahasiswa/list.php">Hapus</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal form mahasiswa -->
<div class="modal fade" id="modalMhs" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="crud-form" action="mahasiswa/proses.php" method="post" data-list="mahasiswa/list.php">
                <div class="modal-header">
                    <h5 class="modal-title">Form Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="simpan">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="number" class="form-control pk" name="nim" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" class="form-control" name="Jurusan" maxlength="50">
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
