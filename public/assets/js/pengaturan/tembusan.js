const modalTembusan = 'tembusanModal'
const formTembusan = 'formTembusan'

$('#tambahTembusan').on('click', function () {
    titleAction('Form Tambah Tembusan', base_url('superadmin/pengaturan/tembusan-surat'))
})

$('#' + modalTembusan).on('hidden.bs.modal', function () {
    titleAction('', base_url(''))
    tutupModal(modalTembusan, 'nama_tembusan')
    tutupModal(modalTembusan, 'html_tembusan')
})

function editTembusan(id) {
    titleAction('Edit Tembusan Surat', base_url('superadmin/pengaturan/tembusan-surat/edit-tembusan/' + id))
    startloading('#' + modalTembusan + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/pengaturan/tembusan-surat/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response)
        setVal(modalTembusan, 'nama_tembusan', response.data.nama_tembusan)
        CKEDITOR.setData(response.data.tembusan_text)
        stoploading('#' + modalTembusan + ' .modal-dialog')
    }).
        fail(function (data, status, error) {
            stoploading('#' + modalTembusan + ' .modal-dialog')
        });
}

function titleAction(title, action) {
    $('#' + modalTembusan + ' .modal-title').html(title)
    $('#' + modalTembusan + ' #' + formTembusan).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
    CKEDITOR.setData('')
}
