modalReqsurat = 'modal-pengajuan'
formReqSurat = 'formReqsurat'

$('#btnTambahRequestSuratKeterangan').on('click', function () {
    titleModal('Ajukan Surat Keterangan Baru', base_url('surat-keterangan/tambah'))
    tutupModal(modalReqsurat, 'nama_surat')
    tutupModal(modalReqsurat, 'perihal')
    tutupModal(modalReqsurat, 'nama_diajukan')
    tutupModal(modalReqsurat, 'email_diajukan')
    tutupModal(modalReqsurat, 'no_telp_diajukan')
    tutupModal(modalReqsurat, 'alamat_diajukan')
})

function editSuratKeterangan(id) {
    titleModal('Revisi Surat', base_url('surat-keterangan/edit/' + id))
    startloading('#' + modalReqsurat)
    var settings = {
        'url': base_url('api/surat-keterangan/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalReqsurat, 'nama_surat', response.data.nama_surat)
        setVal(modalReqsurat, 'perihal', response.data.perihal)
        setVal(modalReqsurat, 'nama_diajukan', response.data.nama_diajukan)
        setVal(modalReqsurat, 'email_diajukan', response.data.email_diajukan)
        setVal(modalReqsurat, 'no_telp_diajukan', response.data.no_telp_diajukan)
        setVal(modalReqsurat, 'alamat_diajukan', response.data.alamat_diajukan)
        stoploading('#' + modalReqsurat)
    }).
    fail(function (data, status, error) {
        stoploading('#' + modalReqsurat)
    });
}

function titleModal(title, action) {
    $('#' + modalReqsurat + ' .modal-title').html(title)
    $('#' + modalReqsurat + ' #' + formReqSurat).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}