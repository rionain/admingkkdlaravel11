const modalTtd = 'ttdModal'
const formTtd = 'formTtd'


$(":file").filestyle({
    buttonName: "btn-primary"
});

$('#tambahTTD').on('click', function () {
    titleAction('Form Tambah Tanda Tangan', base_url('superadmin/administrasi/pengaturan/ttd-surat/tambah-ttd'))
    $('#' + modalTtd + ' .checkboxUbah').css('display', 'none')
    $('#' + modalTtd + ' .fileUpload').css('display', 'block')
})

$('#' + modalTtd).on('hidden.bs.modal', function () {
    titleAction('', base_url(''))
    tutupModal(modalTtd, 'nama_ttd')
    tutupModal(modalTtd, 'lfk_user_id')
    tutupModal(modalTtd, 'jabatan_ttd')
    tutupModal(modalTtd, 'ttd')
    $(":file").filestyle('clear');
    $('#' + modalTtd + ' #showUpload').html('Show')
})

$('#showUpload').click(function () {
    console.log($('#' + modalTtd + ' .fileUpload').css('display'))
    const cek = $('#' + modalTtd + ' .fileUpload').css('display')
    if (cek =='none') {
        $('#' + modalTtd + ' #showUpload').html('Hide')
        $('#' + modalTtd + ' .fileUpload').css('display', 'block')
        tutupModal(modalTtd, 'ttd')


        $(":file").filestyle('clear');
    } else {
        $('#' + modalTtd + ' #showUpload').html('Show')
        $('#' + modalTtd + ' .fileUpload').css('display', 'none')
    }
});



function editTtd(id) {
    titleAction('Edit Tanda Tangan', base_url('superadmin/administrasi/pengaturan/ttd-surat/edit-ttd/' + id))
    $('#' + modalTtd + ' .checkboxUbah').css('display', 'block')
    $('#' + modalTtd + ' .fileUpload').css('display', 'none')
    startloading('#' + modalTtd + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/administrasi/pengaturan/ttd-surat/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalTtd, 'nama_ttd', response.data.nama_ttd)
        setVal(modalTtd, 'lfk_user_id', response.data.lfk_user_id)
        setVal(modalTtd, 'jabatan_ttd', response.data.jabatan_ttd)
        stoploading('#' + modalTtd + ' .modal-dialog')
    }).
    fail(function (data, status, error) {
        stoploading('#' + modalTtd + ' .modal-dialog')
    });
}

// function deleteKop(id){
//     delConf(base_url('admin/mode_setting/delete/'+id))
// }

function titleAction(title, action) {
    $('#' + modalTtd + ' .modal-title').html(title)
    $('#' + modalTtd + ' #' + formTtd).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
