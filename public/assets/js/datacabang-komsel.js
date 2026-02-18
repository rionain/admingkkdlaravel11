const modalKomsel = 'addKomselData'
const formKomsel = 'formKomsel'


$('#tambahKomsel').on('click', function () {
    titleActionKomsel('Form Tambah Komsel', base_url('admin-cabang/database/database-cabang/komsel'))
})

$('#' + modalKomsel).on('hidden.bs.modal', function () {
    titleActionKomsel('', base_url(''))
    tutupModalKomsel(modalKomsel, 'lfk_kategori_komsel_id')
    tutupModalKomsel(modalKomsel, 'nama_komsel')
    tutupModalKomsel(modalKomsel, 'jumlah_pria')
    tutupModalKomsel(modalKomsel, 'jumlah_wanita')
})

function editKomsel(id) {
    titleActionKomsel('Edit Komsel', base_url('admin-cabang/database/database-cabang/komsel/' + id));
    startloading('#' + modalKomsel + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/admin-cabang/database/database-cabang/komsel/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalKomsel, 'lfk_kategori_komsel_id', response.data.lfk_kategori_komsel_id)
        setVal(modalKomsel, 'nama_komsel', response.data.nama_komsel)
        setVal(modalKomsel, 'jumlah_pria', response.data.jumlah_pria)
        setVal(modalKomsel, 'jumlah_wanita', response.data.jumlah_wanita)
        // setVal(modalKomsel, 'jumlah_anggota', response.data.jumlah_anggota)
        // setVal(modalKomsel, 'tanggal', response.data.tanggal)
        stoploading('#' + modalKomsel + ' .modal-dialog')
    }).
        fail(function (data, status, error) {
            stoploading('#' + modalKomsel + ' .modal-dialog')
        });
}
function titleActionKomsel(title, action) {
    $('#' + modalKomsel + ' .modal-title').html(title)
    $('#' + modalKomsel + ' #' + formKomsel).attr('action', action)
}

function tutupModalKomsel(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
