const modalKomsel = 'addKomselData'
const formKomsel = 'formKomsel'

$(`#${modalKomsel} #lfk_kategori_gereja_id`).select2({theme: 'bootstrap'});
$(`#${modalKomsel} #lfk_cabang_id_komsel`).select2({theme: 'bootstrap'});
$(`#${modalKomsel} #lfk_sub_cabang_id`).select2({theme: 'bootstrap'});
$(`#${modalKomsel} #lfk_kategori_komsel_id`).select2({theme: 'bootstrap'});
$(`#${modalKomsel} #lfk_cabang_id`).select2({theme: 'bootstrap'});

var lfk_cabang_id_komsel = $(`#${modalKomsel} #lfk_cabang_id_komsel`).clone();
var lfk_sub_cabang_id = $(`#${formKomsel} #lfk_sub_cabang_id`).clone();

// $(`#${modalKomsel} #lfk_cabang_id_komsel`).chained(`#${modalKomsel} #lfk_kategori_gereja_id`);
// $(`#${modalKomsel} #lfk_sub_cabang_id`).chained(`#${modalKomsel} #lfk_cabang_id_komsel`);

$(`#${modalKomsel} #lfk_cabang_id`).chained(`#${modalKomsel} #lfk_kategori_gereja_id`);


$('#tambahKomsel').on('click', function () {
    titleActionKomsel('Form Tambah Komsel', base_url('superadmin/database/database-cabang/komsel'))
    setVal(modalKomsel, 'nama_komsel', '')
    setVal(modalKomsel, 'jumlah_anggota', '')
    // setVal(modalKomsel, 'tanggal', '')
    setValSelect2(modalKomsel, 'lfk_kategori_gereja_id', '')
    setValSelect2(modalKomsel, 'lfk_cabang_id_komsel', '')
    setValSelect2(modalKomsel, 'lfk_sub_cabang_id', '')
    setValSelect2(modalKomsel, 'lfk_kategori_komsel_id', '')
})

$('#' + modalKomsel).on('hidden.bs.modal', function () {
    titleActionKomsel('', base_url(''))
    setVal(modalKomsel, 'nama_komsel', '')
    setVal(modalKomsel, 'jumlah_pria', '')
    setVal(modalKomsel, 'jumlah_wanita', '')
    setValSelect2(modalKomsel, 'lfk_kategori_gereja_id', '')
    setValSelect2(modalKomsel, 'lfk_cabang_id', '')
    setValSelect2(modalKomsel, 'lfk_kategori_komsel_id', '')
})

function editKomsel(id) {
    titleActionKomsel('Edit Komsel', base_url('superadmin/database/database-cabang/komsel/' + id));
    startloading('#' + modalKomsel + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-cabang/komsel/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response)
        setVal(modalKomsel, 'nama_komsel', response.data.nama_komsel)
        setVal(modalKomsel, 'jumlah_pria', response.data.jumlah_pria)
        setVal(modalKomsel, 'jumlah_wanita', response.data.jumlah_wanita)
        setValSelect2(modalKomsel, 'lfk_kategori_gereja_id', response.data.cabang.lfk_kategori_gereja_id)
        setValSelect2(modalKomsel, 'lfk_cabang_id', response.data.lfk_cabang_id)
        setValSelect2(modalKomsel, 'lfk_kategori_komsel_id', response.data.lfk_kategori_komsel_id)

        stoploading('#' + modalKomsel + ' .modal-dialog')
    })
    .fail(function (data, status, error) {
        stoploading('#' + modalKomsel + ' .modal-dialog')
    });
}

function titleActionKomsel(title, action) {
    $('#' + modalKomsel + ' .modal-title').html(title)
    $('#' + modalKomsel + ' #' + formKomsel).attr('action', action)
}

function tutupModalKomsel(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
