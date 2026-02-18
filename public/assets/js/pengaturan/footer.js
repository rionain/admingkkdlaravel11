const modalFooter = 'footerModal'
const formFooter = 'formFooter'

$('#tambahFooter').on('click', function () {
    titleAction('Form Tambah Footer', base_url('superadmin/pengaturan/footer-surat'))
})

$('#' + modalFooter).on('hidden.bs.modal', function () {
    titleAction('', base_url(''))
    tutupModal(modalFooter, 'nama_footer')
    tutupModal(modalFooter, 'html_footer')
})

function editFooter(id) {
    titleAction('Edit Footer Surat', base_url('superadmin/pengaturan/footer-surat/edit-footer/' + id))
    startloading('#' + modalFooter + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/pengaturan/footer-surat/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalFooter, 'nama_footer', response.data.nama_footer)
        CKEDITOR.setData(response.data.footer)
        stoploading('#' + modalFooter + ' .modal-dialog')
    }).
        fail(function (data, status, error) {
            stoploading('#' + modalFooter + ' .modal-dialog')
        });
}

function titleAction(title, action) {
    $('#' + modalFooter + ' .modal-title').html(title)
    $('#' + modalFooter + ' #' + formFooter).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
    CKEDITOR.setData('')
}
