const modalKelompokpa = 'addKelompokpaData'
const formKelompokpa = 'formKelompokpa'

var lfk_cabang_id = $(`#${formKelompokpa} #lfk_cabang_id`).clone();
var lfk_sub_cabang_id = $(`#${formKelompokpa} #lfk_sub_cabang_id`).clone();
var lfk_kakak_pa_user_id = $(`#${formKelompokpa} #lfk_kakak_pa_user_id`).clone();



$(`#${formKelompokpa} #lfk_kategori_gereja_id`).select2({theme: 'bootstrap'});
$(`#${formKelompokpa} #lfk_cabang_id`).select2({theme: 'bootstrap'});
// $(`#${formKelompokpa} #lfk_sub_cabang_id`).select2({theme: 'bootstrap'});
$(`#${formKelompokpa} #lfk_kakak_pa_user_id`).select2({theme: 'bootstrap'});

$(`#${modalKelompokpa} #lfk_cabang_id`).chained(`#${modalKelompokpa} #lfk_kategori_gereja_id`);
$(`#${modalKelompokpa} #lfk_kakak_pa_user_id`).chained(`#${modalKelompokpa} #lfk_cabang_id`);

$('#tambahKelompokpa').on('click', function () {
    titleActionKelompokpa('Form Tambah Kelompokpa', base_url('superadmin/database/database-cabang/kelompok-pa'))
})

$('#' + modalKelompokpa).on('hidden.bs.modal', function () {
    titleActionKelompokpa('', base_url(''))
    setVal(modalKelompokpa, 'nama_kelompok', '')
    setVal(modalKelompokpa, 'active', '')
    setValSelect2(modalKelompokpa, 'lfk_kakak_pa_user_id', '')
    setValSelect2(modalKelompokpa,'lfk_kategori_gereja_id', '')
    setValSelect2(modalKelompokpa, 'lfk_cabang_id', '')
    setValSelect2(modalKelompokpa, 'lfk_sub_cabang_id', '')
})

function editKelompokpa(id) {
    titleActionKelompokpa('Edit Kelompokpa', base_url('superadmin/database/database-cabang/kelompok-pa/' + id))
    startloading('#' + modalKelompokpa + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-cabang/kelompok-pa/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response)
        setVal(modalKelompokpa, 'active', response?.data?.active)
        setVal(modalKelompokpa, 'nama_kelompok', response?.data?.nama_kelompok)
        setVal(modalKelompokpa, 'lfk_kategori_gereja_id', response?.data?.sub_cabang?.cabang?.lfk_kategori_gereja_id)

        $(`#${modalKelompokpa} #lfk_kategori_gereja_id`).select2({theme: 'bootstrap'});

        $(`#${modalKelompokpa} #lfk_kakak_pa_user_id`).html(lfk_kakak_pa_user_id.html())
        $(`#${modalKelompokpa} #lfk_kakak_pa_user_id`).prop('disabled', false);
        setVal(modalKelompokpa, 'lfk_kakak_pa_user_id', response?.data?.lfk_kakak_pa_user_id)
        $(`#${modalKelompokpa} #lfk_kakak_pa_user_id`).select2({theme: 'bootstrap'});

        $(`#${modalKelompokpa} #lfk_kategori_gereja_id`).select2({theme: 'bootstrap'});
        $(`#${modalKelompokpa} #lfk_cabang_id`).select2({theme: 'bootstrap'});
        $(`#${modalKelompokpa} #lfk_sub_cabang_id`).select2({theme: 'bootstrap'});

        setValSelect2(modalKelompokpa, 'lfk_kategori_gereja_id', response.data.cabang.lfk_kategori_gereja_id)
        setValSelect2(modalKelompokpa, 'lfk_cabang_id', response.data.lfk_cabang_id)

        stoploading('#' + modalKelompokpa + ' .modal-dialog')
    }).
        fail(function (data, status, error) {
            stoploading('#' + modalKelompokpa + ' .modal-dialog')
        });
}

function titleActionKelompokpa(title, action) {
    $('#' + modalKelompokpa + ' .modal-title').html(title)
    $('#' + modalKelompokpa + ' #' + formKelompokpa).attr('action', action)
}

function tutupModalKelompokpa(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
