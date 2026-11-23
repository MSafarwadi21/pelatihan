<?php
$conn = new mysqli("localhost", "root", "", "db_latihan");
$result = $conn->query("SELECT * FROM tbl_semester ORDER BY kd_semester");
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Semester</h1>

    <button class="btn btn-primary mb-3 btn-tambah" data-modal="#modalSemester">Tambah Semester</button>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Semester</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['kd_semester']) ?></td>
                            <td><?= htmlspecialchars($row['semester']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-edit" data-modal="#modalSemester"
                                    data-values='<?= htmlspecialchars(json_encode($row), ENT_QUOTES) ?>'>Edit</button>
                                <button class="btn btn-danger btn-sm btn-hapus" data-url="semester/proses.php"
                                    data-id="<?= htmlspecialchars($row['kd_semester']) ?>"
                                    data-list="semester/list.php">Hapus</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal form semester -->
<div class="modal fade" id="modalSemester" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="crud-form" action="semester/proses.php" method="post" data-list="semester/list.php">
                <div class="modal-header">
                    <h5 class="modal-title">Form Semester</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="simpan">
                    <div class="form-group">
                        <label>Kode Semester</label>
                        <input type="number" class="form-control pk" name="kd_semester" required>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text" class="form-control" name="semester" maxlength="30" required>
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
