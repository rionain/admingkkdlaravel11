const addBahanData = 'addBahanData';
const formBahan = 'formBahan';

$('#tambahBahan').on('click', function () {
    titleActionBahan('Form Tambah Bahan', base_url(
        'superadmin/database/database-permuridan/bahan'))
});

$('#' + addBahanData).on('hidden.bs.modal', function () {
    titleActionBahan('', base_url(''))
    tutupModal(addBahanData, 'judul')
    tutupModal(addBahanData, 'tahun_terbit')
    tutupModal(addBahanData, 'deskripsi')
    $('.selectpicker').selectpicker('refresh')
});

function editBahanPA(id) {
    console.log(id)
    titleActionBahan('Edit Bahan', base_url('superadmin/database/database-permuridan/bahan/' + id))
    startloading('#' + addBahanData + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-permuridan/bahan/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response.data)
        setVal(addBahanData, 'judul', response.data.judul)
        setVal(addBahanData, 'tahun_terbit', response.data.tahun_terbit)
        setVal(addBahanData, 'deskripsi', response.data.deskripsi)

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
