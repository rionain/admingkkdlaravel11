const addAnakPAData = 'addAnakData';
const formAnakPA = 'formAnakPA';

var cabangAnakPACopy = $(`#${addAnakPAData} #cabangAnakPA`).clone();
var kelompok_paCopy = $(`#${addAnakPAData} #kelompok_pa`).clone();
var lfk_bahan_pa_idCopy = $(`#${addAnakPAData} #lfk_bahan_pa_id`).clone();
$(`#${addAnakPAData} #kelompok_pa`).chained(`#${addAnakPAData} #cabangAnakPA`);
// $(`#${addAnakPAData} #lfk_bahan_pa_id`).chained(`#${addAnakPAData} #kelompok_pa`);



$(`#${addAnakPAData} #cabangAnakPA`).change(()=>{
    $('.selectpicker').selectpicker('refresh');
});
$(`#${addAnakPAData} #kelompok_pa`).change(()=>{
    $('.selectpicker').selectpicker('refresh');
});

$('#tambahAnak').on('click', function () {
    titleActionAnakPA('Form Tambah Anak PA', base_url(
        'admin-cabang/database/database-permuridan/anak-pa'))
});

$('#' + addAnakPAData).on('hidden.bs.modal', function () {
    titleActionAnakPA('', base_url(''))
    tutupModal(addAnakPAData, 'nama')
    tutupModal(addAnakPAData, 'email')
    tutupModal(addAnakPAData, 'phone')
    tutupModal(addAnakPAData, 'alamat')

    tutupModal(addAnakPAData, 'cabangAnakPA')

    $(`#${addAnakPAData} #kelompok_pa`).html(kelompok_paCopy.html())
    tutupModal(addAnakPAData, 'kelompok_pa')
    $(`#${addAnakPAData} #kelompok_pa`).chained(`#${addAnakPAData} #cabangAnakPA`);

    $(`#${addAnakPAData} #lfk_bahan_pa_id`).html(lfk_bahan_pa_idCopy.html())
    tutupModal(addAnakPAData, 'lfk_bahan_pa_id')
    $(`#${addAnakPAData} #lfk_bahan_pa_id`).chained(`#${addAnakPAData} #kelompok_pa`);
    $('.selectpicker').selectpicker('refresh')
});

function editAnakPA(id) {
    titleActionAnakPA('Edit Anak PA', base_url('admin-cabang/database/database-permuridan/anak-pa/' + id))
    startloading('#' + addAnakPAData + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/admin-cabang/database/database-permuridan/anak-pa/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response)
        setVal(addAnakPAData, 'nama', response.data.nama)
        setVal(addAnakPAData, 'email', response.data.email)
        var $radios = $(`#${addAnakPAData} input:radio[name=gender]`);
        $radios.filter(`[value=${response.data.gender}]`).prop('checked', true);
        setVal(addAnakPAData, 'phone', response.data.phone)
        setVal(addAnakPAData, 'alamat', response.data.alamat)
        setVal(addAnakPAData, 'cabangAnakPA', response.data.lfk_cabang_id)
        $('.selectpicker').selectpicker('refresh')

        $(`#${addAnakPAData} #kelompok_pa`).html(kelompok_paCopy.html())
        setVal(addAnakPAData, 'kelompok_pa', response.data.anak_pa_detail?.lfk_kelompok_pa_id)
        $(`#${addAnakPAData} #kelompok_pa`).chained(`#${addAnakPAData} #cabangAnakPA`);
        $('.selectpicker').selectpicker('refresh')

        $(`#${addAnakPAData} #lfk_bahan_pa_id`).html(lfk_bahan_pa_idCopy.html())
        // console.log($('#lfk_bahan_pa_id').val())
        // $(`#${addAnakPAData} #lfk_bahan_pa_id`).chained(`#${addAnakPAData} #kelompok_pa`);
        // console.log($('#lfk_bahan_pa_id').val())
        setVal(formAnakPA, 'lfk_bahan_pa_id', response.data.anak_pa_detail?.lfk_bahan_pa_id)
        // console.log(response.data.anak_pa_detail?.lfk_bahan_pa_id,$(`#${addAnakPAData} #lfk_bahan_pa_id`).val())
        $('.selectpicker').selectpicker('refresh')

        stoploading('#' + addAnakPAData + ' .modal-dialog')
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
        stoploading('#' + addAnakPAData + ' .modal-dialog')
    });
}

function titleActionAnakPA(title, action) {
    $('#' + addAnakPAData + ' .modal-title').html(title)
    $('#' + addAnakPAData + ' #' + formAnakPA).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
