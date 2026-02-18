const addKakakPAData = 'addKakakData';
const editKakakPAData = 'editKakakData';
const addFormKakakPA = 'addFormKakakPA';
const editFormKakakPA = 'editFormKakakPA';

var lfk_kategori_gereja_id = $(`#${editKakakPAData} #lfk_kategori_gereja_id`).clone();
var lfk_cabang_id = $(`#${editKakakPAData} #lfk_cabang_id`).clone();

$(document).ready(function () {

    $(`#${addKakakPAData} #lfk_cabang_id`).chained(`#${addKakakPAData} #lfk_kategori_gereja_id`);

    $(`#${editFormKakakPA} #lfk_cabang_id`).chained(`#${editFormKakakPA} #lfk_kategori_gereja_id`);

    $(`#${addKakakPAData} #lfk_kategori_gereja_id`).select2({ theme: 'bootstrap' });
    $(`#${addKakakPAData} #lfk_cabang_id`).select2({ theme: 'bootstrap' });

    $(`#${editKakakPAData} #lfk_kategori_gereja_id`).select2({ theme: 'bootstrap' });
    $(`#${editKakakPAData} #lfk_cabang_id`).select2({ theme: 'bootstrap' });

    $('#tambahKakak').on('click', function () {
        titleAddActionKakakPA('Form Tambah Pembimbing PA', base_url(
            'superadmin/database/database-permuridan/kakak-pa'))
    });

    $('#' + addKakakPAData).on('hidden.bs.modal', function () {
        titleActionKakakPA('', base_url(''))
        tutupModal(addKakakPAData, 'nama')
        tutupModal(addKakakPAData, 'email')
        tutupModal(addKakakPAData, 'phone')
        tutupModal(addKakakPAData, 'alamat')
        tutupModal(addKakakPAData, 'password')
        tutupModal(addKakakPAData, 'password_confirmation')
        tutupModal(addKakakPAData, 'lfk_kategori_gereja_id')
        tutupModal(addKakakPAData, 'lfk_cabang_id')

        $(`#${addKakakPAData} #lfk_kategori_gereja_id`).select2({ theme: 'bootstrap' });
        $(`#${addKakakPAData} #lfk_cabang_id`).select2({ theme: 'bootstrap' });
    });
    $('#' + editKakakPAData).on('hidden.bs.modal', function () {
        titleActionKakakPA('', base_url(''))
        tutupModal(editKakakPAData, 'nama')
        tutupModal(editKakakPAData, 'email')
        tutupModal(editKakakPAData, 'phone')
        tutupModal(editKakakPAData, 'alamat')
        tutupModal(editKakakPAData, 'lfk_kategori_gereja_id')
        tutupModal(editKakakPAData, 'lfk_cabang_id')

        $(`#${editKakakPAData} #lfk_kategori_gereja_id`).select2({ theme: 'bootstrap' });
        $(`#${editKakakPAData} #lfk_cabang_id`).select2({ theme: 'bootstrap' });
    });


});

function titleActionKakakPA(title, action) {
    $('#' + editKakakPAData + ' .modal-title').html(title)
    $('#' + editKakakPAData + ' #' + editFormKakakPA).attr('action', action)
}

function titleAddActionKakakPA(title, action) {
    $('#' + addKakakPAData + ' .modal-title').html(title)
    $('#' + addKakakPAData + ' #' + addFormKakakPA).attr('action', action)
}

function tutupModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}

function editKakakPA(id) {
    titleActionKakakPA('Edit Pembimbing PA', base_url('superadmin/database/database-permuridan/kakak-pa/' + id))
    startloading('#' + editKakakPAData + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-permuridan/kakak-pa/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response)
        $(`#${editFormKakakPA} #lfk_cabang_id`).unbind(`#${editFormKakakPA} #lfk_kategori_gereja_id`);

        setVal(editKakakPAData, 'nama', response.data.nama)
        setVal(editKakakPAData, 'email', response.data.email)
        var $radios = $(`#${editKakakPAData} input:radio[name=gender]`);
        $radios.filter(`[value=${response.data.gender}]`).prop('checked', true);
        setVal(editKakakPAData, 'phone', response.data.phone)
        setVal(editKakakPAData, 'alamat', response.data.alamat)

        setVal(editKakakPAData, 'lfk_kategori_gereja_id', response.data.cabang.lfk_kategori_gereja_id)
        $(`#${editKakakPAData} #lfk_kategori_gereja_id`).select2({ theme: 'bootstrap' });

        $(`#${editKakakPAData} #lfk_cabang_id`).html(lfk_cabang_id.html());
        $(`#${editKakakPAData} #lfk_cabang_id`).attr('disabled', false);
        setVal(editKakakPAData, 'lfk_cabang_id', response.data.lfk_cabang_id)
        $(`#${editKakakPAData} #lfk_cabang_id`).select2({ theme: 'bootstrap' });


        $(`#${editFormKakakPA} #lfk_cabang_id`).chained(`#${editFormKakakPA} #lfk_kategori_gereja_id`);


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
