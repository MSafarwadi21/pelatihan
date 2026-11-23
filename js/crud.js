// Fungsi bersama untuk halaman CRUD (master & transaksi)

// Memuat halaman list ke dalam #contentData pada dashboard
function loadPage(url) {
    $.get(url, function (data) {
        $('#contentData').html(data);
    });
}

// Tombol Tambah: kosongkan form, mode simpan
$(document).on('click', '.btn-tambah', function () {
    var modal = $($(this).data('modal'));
    modal.find('form')[0].reset();
    modal.find('[name=action]').val('simpan');
    modal.find('.pk').prop('readonly', false);
    modal.modal('show');
});

// Tombol Edit: isi form dengan data baris, mode update
$(document).on('click', '.btn-edit', function () {
    var btn = $(this);
    var vals = btn.data('values');
    var modal = $(btn.data('modal'));
    modal.find('form')[0].reset();
    modal.find('[name]').each(function () {
        var n = $(this).attr('name');
        if (vals && n in vals) {
            $(this).val(vals[n]);
        }
    });
    modal.find('[name=action]').val('update');
    modal.find('.pk').prop('readonly', true); // kunci utama tidak diubah
    modal.modal('show');
});

// Submit form tambah/edit: kirim ke proses.php lalu muat ulang list
$(document).on('submit', 'form.crud-form', function (e) {
    e.preventDefault();
    var form = $(this);
    $.post(form.attr('action'), form.serialize(), function (res) {
        if (res.indexOf('OK') === 0) {
            form.closest('.modal').modal('hide');
            alert(res);
            loadPage(form.data('list'));
        } else {
            alert(res);
        }
    });
});

// Tombol Hapus
$(document).on('click', '.btn-hapus', function () {
    if (!confirm('Yakin ingin menghapus data ini?')) {
        return;
    }
    var btn = $(this);
    $.post(btn.data('url'), { action: 'hapus', id: btn.data('id') }, function (res) {
        alert(res);
        if (res.indexOf('OK') === 0) {
            loadPage(btn.data('list'));
        }
    });
});
