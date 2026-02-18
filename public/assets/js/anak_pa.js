const addAnakPAData = 'addAnakData';
const formAnakPA = 'formAnakPA';

var lfk_kategori_gereja_idCopy = $(`#${addAnakPAData} #lfk_kategori_gereja_id`).clone();
var lfk_cabang_idCopy = $(`#${addAnakPAData} #lfk_cabang_id`).clone();
var lfk_sub_cabang_idCopy = $(`#${addAnakPAData} #lfk_sub_cabang_id`).clone();
var kelompok_paCopy = $(`#${addAnakPAData} #kelompok_pa`).clone();
var lfk_bahan_pa_id = $(`#${addAnakPAData} #lfk_bahan_pa_id`).clone();


function editAnakPA(id) {
    titleActionAnakPA('Edit Anak PA', base_url('superadmin/database/database-permuridan/anak-pa/' + id))
    startloading('#' + addAnakPAData + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-permuridan/anak-pa/' + id),
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



        setVal(addAnakPAData, 'lfk_kategori_gereja_id', response.data.sub_cabang.cabang.lfk_kategori_gereja_id)
        $(`#${addAnakPAData} #lfk_kategori_gereja_id`).select2();

        $(`#${addAnakPAData} #lfk_cabang_id`).html(lfk_cabang_idCopy.html());
        $(`#${addAnakPAData} #lfk_cabang_id`).attr('disabled', false);
        setVal(addAnakPAData, 'lfk_cabang_id', response.data.sub_cabang.lfk_cabang_id)
        $(`#${addAnakPAData} #lfk_cabang_id`).select2();

        $(`#${addAnakPAData} #lfk_sub_cabang_id`).html(lfk_sub_cabang_idCopy.html());
        $(`#${addAnakPAData} #lfk_sub_cabang_id`).attr('disabled', false);
        setVal(addAnakPAData, 'lfk_sub_cabang_id', response.data.lfk_sub_cabang_id)
        $(`#${addAnakPAData} #lfk_sub_cabang_id`).select2();

        $(`#${addAnakPAData} #kelompok_pa`).html(kelompok_paCopy.html());
        $(`#${addAnakPAData} #kelompok_pa`).attr('disabled', false);
        setVal(addAnakPAData, 'kelompok_pa', response.data.anak_pa_detail?.lfk_kelompok_pa_id)
        $(`#${addAnakPAData} #kelompok_pa`).select2();

        setVal(formAnakPA, 'lfk_bahan_pa_id', response.data.anak_pa_detail?.lfk_bahan_pa_id)
        $(`#${addAnakPAData} #lfk_bahan_pa_id`).select2();


        $(`#${addAnakPAData} #lfk_cabang_id`).chained(`#${addAnakPAData} #lfk_kategori_gereja_id`);
        $(`#${addAnakPAData} #lfk_sub_cabang_id`).chained(`#${addAnakPAData} #lfk_cabang_id`);
        $(`#${addAnakPAData} #kelompok_pa`).chained(`#${addAnakPAData} #lfk_sub_cabang_id`);

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


$(document).ready(function () {

    $(`#${addAnakPAData} #lfk_kategori_gereja_id`).select2();
    $(`#${addAnakPAData} #lfk_cabang_id`).select2();
    $(`#${addAnakPAData} #lfk_sub_cabang_id`).select2();
    $(`#${addAnakPAData} #kelompok_pa`).select2();
    $(`#${addAnakPAData} #lfk_bahan_pa_id`).select2();

    $(`#${addAnakPAData} #lfk_cabang_id`).chained(`#${addAnakPAData} #lfk_kategori_gereja_id`);
    $(`#${addAnakPAData} #lfk_sub_cabang_id`).chained(`#${addAnakPAData} #lfk_cabang_id`);
    $(`#${addAnakPAData} #kelompok_pa`).chained(`#${addAnakPAData} #lfk_sub_cabang_id`);
    // $(`#${addAnakPAData} #lfk_bahan_pa_id`).chained(`#${addAnakPAData} #kelompok_pa`);



    $('#tambahAnak').on('click', function () {
        titleActionAnakPA('Form Tambah Anak PA', base_url(
            'superadmin/database/database-permuridan/anak-pa'))
    });

    $('#' + addAnakPAData).on('hidden.bs.modal', function () {
        titleActionAnakPA('', base_url(''))
        tutupModal(addAnakPAData, 'nama')
        tutupModal(addAnakPAData, 'email')
        tutupModal(addAnakPAData, 'phone')
        tutupModal(addAnakPAData, 'alamat')
        tutupModal(addAnakPAData, 'lfk_kategori_gereja_id')
        tutupModal(addAnakPAData, 'lfk_cabang_id')
        tutupModal(addAnakPAData, 'lfk_sub_cabang_id')
        tutupModal(addAnakPAData, 'kelompok_pa')
        tutupModal(addAnakPAData, 'lfk_bahan_pa_id')

        $(`#${addAnakPAData} #lfk_kategori_gereja_id`).select2();
        $(`#${addAnakPAData} #lfk_cabang_id`).select2();
        $(`#${addAnakPAData} #lfk_sub_cabang_id`).select2();
        $(`#${addAnakPAData} #kelompok_pa`).select2();
        $(`#${addAnakPAData} #lfk_bahan_pa_id`).select2();
    });
});
