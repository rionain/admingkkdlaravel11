const modalBody          = 'bodySuratModal'
// const modalDetailKop    = 'modalDetailKop'
const formBody           = 'formBody'

$('#tambahBody').on('click', function(){
    titleAction('Form Tambah Body', base_url('superadmin/administrasi/pengaturan/body-surat/tambah-body'))
})

$('#'+modalBody).on('hidden.bs.modal', function(){
    titleAction('', base_url(''))
    tutupModal(modalBody, 'nama_body')
    tutupModal(modalBody, 'html_body')
})

function editBody(id){
    titleAction('Edit Body Surat', base_url('superadmin/administrasi/pengaturan/body-surat/edit-body/'+id))
    startloading('#'+modalBody+' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/administrasi/pengaturan/body-surat/'+id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalBody, 'nama_body', response.data.nama_body)
        CKEDITOR.setData(response.data.html_body)
        stoploading('#'+modalBody+' .modal-dialog')
    }).
    fail(function(data, status, error){
        // console.log('data: '+data)
        // console.log('status: '+status)
        // console.log('error: '+error)
        // if(status == 'timeout'){
        //     CekKonfirmasi('Timeout!', '')
        // } else if(data.responseJSON.status == false){
        //     CekKonfirmasi(data.responseJSON.message, '')
        // }
        stoploading('#'+modalBody+' .modal-dialog')
    });
}

function titleAction(title, action){
    $('#'+modalBody+' .modal-title').html(title)
    $('#'+modalBody+' #'+formBody).attr('action', action)
}

function tutupModal(modal, id){
    $('#'+modal+' #'+id).val('')
    $('#'+modal+' #'+id).removeClass('is-invalid')
    CKEDITOR.setData('')
}
