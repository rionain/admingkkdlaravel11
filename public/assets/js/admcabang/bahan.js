const addBahanData = 'addBahanData';
const formBahan = 'formBahan';

$('#tambahBahan').on('click', function () {
    titleActionBahan('Form Tambah Bahan', base_url(
        'admin-cabang/database/database-permuridan/bahan'))
    $(`#${addBahanData} #txt-file`).css('display', 'none')
});

$('#' + addBahanData).on('hidden.bs.modal', function () {
    titleActionBahan('', base_url(''))
    tutupModal(addBahanData, 'title')
    tutupModal(addBahanData, 'tahun_session_bahan_pa')
    tutupModal(addBahanData, 'bahan_pa_desc')
    tutupModal(addBahanData, 'buku_pa')
    $('.selectpicker').selectpicker('refresh')
});

function editBahanPA(id) {
    console.log(id)
    titleActionBahan('Edit Bahan', base_url('admin-cabang/database/database-permuridan/bahan/' + id))
    startloading('#' + addBahanData + ' .modal-dialog')
    $(`#${addBahanData} #txt-file`).css('display', 'inline')
    var settings = {
        'url': base_url('api/v1/admin-cabang/database/database-permuridan/bahan/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response.data)
        setVal(addBahanData, 'title', response.data.title)
        setVal(addBahanData, 'tahun_session_bahan_pa', response.data.tahun_session_bahan_pa)
        setVal(addBahanData, 'bahan_pa_desc', response.data.bahan_pa_desc)
        setVal(addBahanData, 'buku_pa', response.data.buku_pa)

        $('.selectpicker').selectpicker('refresh')
        stoploading('#' + addBahanData + ' .modal-dialog')
    }).
    fail(function (data, status, error) {
        // console.log('data: '+data)
        // console.log('status: '+status)
        // console.log('error: '+error)
        // if(status == 'timeout'){
        //     CekKonfirmasi('Timeout!', '')
        // } else if(data.responseJSON.status == false){
        //     CekKonfirmasi(data.responseJSON.message, '')
        // }
        stoploading('#' + addBahanData + ' .modal-dialog')
    });
}

function titleActionBahan(title, action) {
    $('#' + addBahanData + ' .modal-title').html(title)
    $('#' + addBahanData + ' #' + formBahan).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
