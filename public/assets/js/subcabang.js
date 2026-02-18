const modalSubCabang = 'modalSubCabang';
const formSubCabang = 'formSubCabang';

function tambahSubCabang(cabang_id) {
    titleAction('Form Tambah Sub Cabang', base_url(
        `superadmin/database/database-cabang/cabang/${cabang_id}/sub_cabang`))
}

$('#' + modalSubCabang).on('hidden.bs.modal', function () {
    titleAction('', base_url(''))
    setValSelect2(modalSubCabang, 'lfk_kategori_gereja_id', '')
    setVal(modalSubCabang, 'nama_cabang', '')
    setVal(modalSubCabang, 'info_detail', '')
});

function editSubCabang(cabang_id, id) {
    // cabang_id = id_cabang
    // id = id_sub_cabang

    titleAction('Edit Sub Cabang', base_url('superadmin/database/database-cabang/cabang/'+cabang_id+'/sub_cabang/'+ id))

    startloading('#' + modalSubCabang + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-cabang/cabang/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(id)
        console.log(response)
        setValSelect2(modalSubCabang, 'lfk_kategori_gereja_id', response.data.lfk_kategori_gereja_id)
        setVal(modalSubCabang, 'nama_cabang', response.data.nama_cabang)
        setVal(modalSubCabang, 'info_detail', response.data.info_detail)

        stoploading('#' + modalSubCabang + ' .modal-dialog')
        stoploading('#' + modalSubCabang + ' .modal-dialog')
    }).
    fail(function (data, status, error) {
        stoploading('#' + modalSubCabang + ' .modal-dialog')
    });
}

function titleAction(title, action) {
    $('#' + modalSubCabang + ' .modal-title').html(title)
    $('#' + modalSubCabang + ' #' + formSubCabang).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
