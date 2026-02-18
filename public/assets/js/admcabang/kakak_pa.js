const addKakakPAData = 'addKakakData';
const editKakakPAData = 'editKakakData';
const addFormKakakPA = 'addFormKakakPA';
const editFormKakakPA = 'editFormKakakPA';

$('#tambahKakak').on('click', function () {
    titleActionKakakPA('Form Tambah Pembimbing PA', base_url(
        'admin-cabang/database/database-permuridan/kakak-pa'))
});

$('#' + addKakakPAData).on('hidden.bs.modal', function () {
    titleActionKakakPA('', base_url(''))
    tutupModal(addKakakPAData, 'nama')
    tutupModal(addKakakPAData, 'email')
    tutupModal(addKakakPAData, 'phone')
    tutupModal(addKakakPAData, 'alamat')
    tutupModal(addKakakPAData, 'cabang')
    tutupModal(addKakakPAData, 'password')
    tutupModal(addKakakPAData, 'password_confirmation')
    $('.selectpicker').selectpicker('refresh')
});
$('#' + editKakakPAData).on('hidden.bs.modal', function () {
    titleActionKakakPA('', base_url(''))
    tutupModal(editKakakPAData, 'nama')
    tutupModal(editKakakPAData, 'email')
    tutupModal(editKakakPAData, 'phone')
    tutupModal(editKakakPAData, 'alamat')
    tutupModal(editKakakPAData, 'cabang')
    $('.selectpicker').selectpicker('refresh')
});

function editKakakPA(id) {
    titleActionKakakPA('Edit Pembimbing PA', base_url('admin-cabang/database/database-permuridan/kakak-pa/' + id))
    startloading('#' + editKakakPAData + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/admin-cabang/database/database-permuridan/kakak-pa/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response)
        setVal(editKakakPAData, 'nama', response.data.nama)
        setVal(editKakakPAData, 'email', response.data.email)
        var $radios = $(`#${editKakakPAData} input:radio[name=gender]`);
        $radios.filter(`[value=${response.data.gender}]`).prop('checked', true);
        setVal(editKakakPAData, 'phone', response.data.phone)
        setVal(editKakakPAData, 'alamat', response.data.alamat)
        setVal(editKakakPAData, 'cabang', response.data.lfk_cabang_id)

        $('.selectpicker').selectpicker('refresh')
        stoploading('#' + editKakakPAData + ' .modal-dialog')
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
        stoploading('#' + editKakakPAData + ' .modal-dialog')
    });
}

function titleActionKakakPA(title, action) {
    $('#' + addKakakPAData + ' .modal-title').html(title)
    $('#' + addKakakPAData + ' #' + addFormKakakPA).attr('action', action)
    $('#' + editKakakPAData + ' .modal-title').html(title)
    $('#' + editKakakPAData + ' #' + editFormKakakPA).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
