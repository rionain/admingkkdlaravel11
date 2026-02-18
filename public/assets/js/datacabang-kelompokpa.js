const modalKelompokpa = 'addKelompokpaData'
const formKelompokpa = 'formKelompokpa'


$('#tambahKelompokpa').on('click', function () {
    titleActionKelompokpa('Form Tambah Kelompokpa', base_url('admin-cabang/database/database-cabang/kelompok-pa'))
})

$('#' + modalKelompokpa).on('hidden.bs.modal', function () {
    titleActionKelompokpa('', base_url(''))
    tutupModalKelompokpa(modalKelompokpa, 'nama_kelompok')
    tutupModalKelompokpa(modalKelompokpa, 'lfk_kakak_pa_user_id')
    tutupModalKelompokpa(modalKelompokpa, 'active')
})

function editKelompokpa(id) {
    titleActionKelompokpa('Edit Kelompokpa', base_url('admin-cabang/database/database-cabang/kelompok-pa/' + id))
    startloading('#' + modalKelompokpa + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/admin-cabang/database/database-cabang/kelompok-pa/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalKelompokpa, 'nama_kelompok', response.data.nama_kelompok)
        setVal(modalKelompokpa, 'lfk_kakak_pa_user_id', response.data.lfk_kakak_pa_user_id)
        setVal(modalKelompokpa, 'active', response.data.active)
        stoploading('#' + modalKelompokpa + ' .modal-dialog')
    }).
        fail(function (data, status, error) {
            stoploading('#' + modalKelompokpa + ' .modal-dialog')
        });
}
function titleActionKelompokpa(title, action) {
    $('#' + modalKelompokpa + ' .modal-title').html(title)
    $('#' + modalKelompokpa + ' #' + formKelompokpa).attr('action', action)
}

function tutupModalKelompokpa(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
