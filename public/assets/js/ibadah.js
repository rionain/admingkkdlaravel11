const modalIbadah       = 'addIbadahData'
const formIbadah        = 'formIbadah'
const modalDetailIbadah = 'modalDetailIbadah'

var wilayahLayanan = $(`#${modalIbadah} #wilayahLayanan`).clone();
var lfk_sub_cabang_id = $(`#${modalIbadah} #lfk_sub_cabang_id`).clone();
$(`#${modalIbadah} #lfk_sub_cabang_id`).select2({theme: 'bootstrap'});

$(function(){
    IbadahValidation(formIbadah)

    $(`#${modalIbadah} #wilayahLayanan`).chained(`#${modalIbadah} #lfk_kategori_gereja_id`);
    $(`#${modalIbadah} #lfk_sub_cabang_id`).chained(`#${modalIbadah} #wilayahLayanan`);
    $(`#${modalIbadah} #lfk_kategori_gereja_id`).select2({theme: 'bootstrap'});
    $(`#${modalIbadah} #wilayahLayanan`).select2({theme: 'bootstrap'});
    $(`#${modalIbadah} #lfk_cabang_id`).select2({theme: 'bootstrap'});

    $('#' + modalIbadah + ' #ibadah_time_start').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        weekStart: 0,
        date: false,
        time: true
    }).on('change', function(e, date) {
        $('#'+modalIbadah+' #ibadah_time_end').bootstrapMaterialDatePicker('setMinDate', date);
    });

    $('#'+modalIbadah+' #ibadah_time_end').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        weekStart: 0,
        date: false,
        time: true
    }).on('change', function(e, date) {
        $('#'+modalIbadah+' #ibadah_time_start').bootstrapMaterialDatePicker('setMaxDate', date);
    });

    $(`#${modalIbadah} #lfk_cabang_id`).chained(`#${modalIbadah} #lfk_kategori_gereja_id`);
})

$('#' + modalIbadah + ' #ibadah_time_start').change((e) => {
    let ibadah_mulai = $('#' + modalIbadah + ' #ibadah_time_start').val();
    $('#' + modalIbadah + ' #ibadah_time_end').attr('min', ibadah_mulai);
})

function clear_all_ibadah() {
    hiddenModal(modalIbadah, 'nama_ibadah')
    hiddenModal(modalIbadah, 'ibadah_time_start')
    hiddenModal(modalIbadah, 'ibadah_time_end')
    hiddenModal(modalIbadah, 'wilayahLayanan')
    hiddenModal(modalIbadah, 'kapasitasIbadah')
    hiddenModal(modalIbadah, 'wilayahLayanan')
    hiddenModal(modalIbadah, 'lfk_kategori_gereja_id')
    hiddenModal(modalIbadah, 'lfk_cabang_id')
    hiddenModal(modalIbadah, 'ibadah_day')

    setValSelect2(modalIbadah,'wilayahLayanan', '')
    setValSelect2(modalIbadah,'lfk_kategori_gereja_id', '')
    setValSelect2(modalIbadah, 'lfk_cabang_id', '')
    setValSelect2(modalIbadah,'ibadah_day', '')
}

$('#tambahIbadah').on('click', function () {
    titleActionIbadah('Form Tambah Ibadah', base_url('superadmin/database/database-cabang/ibadah'));
    clear_all_ibadah();
})

$('#' + modalIbadah).on('hidden.bs.modal', function () {
    titleActionIbadah('', base_url(''))
    clear_all_ibadah();
})

$('#' + modalDetailIbadah).on('hidden.bs.modal', function () {
    setHtmlVal(modalDetailIbadah, 'kategori_gereja', kosong())
    setHtmlVal(modalDetailIbadah, 'nama_gereja', kosong())
    setHtmlVal(modalDetailIbadah, 'nama_ibadah', kosong())
    setHtmlVal(modalDetailIbadah, 'hari', kosong())
    setHtmlVal(modalDetailIbadah, 'jam_mulai', kosong())
    setHtmlVal(modalDetailIbadah, 'jam_selesai', kosong())
    setHtmlVal(modalDetailIbadah, 'kapasitas', kosong())
    setHtmlVal(modalDetailIbadah, 'notes', kosong())
    setHtmlVal(modalDetailIbadah, 'status_ibadah', kosong())
})

function editIbadah(id) {
    titleActionIbadah('Edit Ibadah', base_url('superadmin/database/database-cabang/ibadah/' + id));
    startloading('#' + modalIbadah + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-cabang/ibadah/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalIbadah, 'nama_ibadah', response?.data?.nama_ibadah)
        setVal(modalIbadah, 'ibadah_time_start', response?.data?.ibadah_time_start)
        setVal(modalIbadah, 'ibadah_time_end', response?.data?.ibadah_time_end)
        setVal(modalIbadah, 'kapasitasIbadah', response?.data?.kapasitas_ibadah)
        setVal(modalIbadah, 'ibadah_day', response?.data?.ibadah_day)
        setVal(modalIbadah, 'activeIbadah', response?.data?.ibadah_status)
        setVal(modalIbadah, 'notes', response?.data?.notes)

        setValSelect2(modalIbadah, 'lfk_kategori_gereja_id', response.data.cabang.lfk_kategori_gereja_id)
        setValSelect2(modalIbadah, 'lfk_cabang_id', response.data.lfk_cabang_id)
        if ((response?.data?.ibadah_status != 1 && $('#activeIbadah').is(':checked')) || (response?.data?.ibadah_status == 1 && !$('#activeIbadah').is(':checked'))) {
            $('#activeIbadah').click();
        }
        // setVal(modalIbadah, 'lfk_kategori_gereja_id', response?.data?.sub_cabang?.cabang?.lfk_kategori_gereja_id)
        // $(`#${modalIbadah} #lfk_kategori_gereja_id`).select2({theme: 'bootstrap'});

        $(`#${modalIbadah} #wilayahLayanan`).html(wilayahLayanan.html())
        $(`#${modalIbadah} #wilayahLayanan`).prop('disabled', false);
        setVal(modalIbadah, 'wilayahLayanan', response?.data?.sub_cabang?.lfk_cabang_id)
        $(`#${modalIbadah} #wilayahLayanan`).select2({theme: 'bootstrap'});

        $(`#${modalIbadah} #lfk_sub_cabang_id`).html(lfk_sub_cabang_id.html())
        $(`#${modalIbadah} #lfk_sub_cabang_id`).prop('disabled', false);
        $(`#${modalIbadah} #selectpicker`).select2({theme: 'bootstrap'});
        setVal(modalIbadah, 'lfk_sub_cabang_id', response?.data?.sub_cabang?.sub_cabang_id)
        $(`#${modalIbadah} #lfk_sub_cabang_id`).select2({theme: 'bootstrap'});


        // $(`#${modalIbadah} #wilayahLayanan`).chained(`#${modalIbadah} #lfk_kategori_gereja_id`);
        $(`#${modalIbadah} #lfk_sub_cabang_id`).chained(`#${modalIbadah} #wilayahLayanan`);


        // $(`#${modalIbadah} #lfk_kategori_gereja_id`).select2({theme: 'bootstrap'});
        $(`#${modalIbadah} #wilayahLayanan`).select2({theme: 'bootstrap'});
        $(`#${modalIbadah} #lfk_sub_cabang_id`).select2({theme: 'bootstrap'});

        setValSelect2(modalIbadah, 'ibadah_day', response.data.ibadah_day)

        stoploading('#' + modalIbadah + ' .modal-dialog')
    }).
    fail(function (data, status, error) {
        stoploading('#' + modalIbadah + ' .modal-dialog')
    });
}

function detailIbadah(id){
    startloading('#' + modalDetailIbadah + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-cabang/ibadah/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setHtmlVal(modalDetailIbadah, 'kategori_gereja', response.data.cabang.kategori_gereja.kategori_gereja)
        setHtmlVal(modalDetailIbadah, 'nama_gereja', response.data.cabang.nama_cabang)
        setHtmlVal(modalDetailIbadah, 'nama_ibadah', response.data.nama_ibadah)
        setHtmlVal(modalDetailIbadah, 'hari', response.data.ibadah_day)
        setHtmlVal(modalDetailIbadah, 'jam_mulai', response.data.ibadah_time_start)
        setHtmlVal(modalDetailIbadah, 'jam_selesai', response.data.ibadah_time_end)
        setHtmlVal(modalDetailIbadah, 'kapasitas', response.data.kapasitas_ibadah)
        setHtmlVal(modalDetailIbadah, 'notes', response.data.notes)
        let status = ''
        if(response.data.active === '1') {
            status = badge('success', 'Aktif')
        } else {
            status = badge('danger', 'Tidak Aktif')
        }
        setHtmlVal(modalDetailIbadah, 'status_ibadah', status)
        stoploading('#' + modalDetailIbadah + ' .modal-dialog')
    }).
    fail(function (data, status, error) {
        stoploading('#' + modalDetailIbadah + ' .modal-dialog')
    });
}

function titleActionIbadah(title, action) {
    $('#' + modalIbadah + ' .modal-title').html(title)
    $('#' + modalIbadah + ' #' + formIbadah).attr('action', action)
}

function tutupModalIbadah(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}

function IbadahValidation(id) {
    $('#'+id).validate({
        rules: {
            nama_ibadah: {
                required: true
            },
            ibadah_time_start: {
                required: true
            },
            ibadah_time_end: {
                required: true
            },
            lfk_kategori_gereja_id: {
                required: true
            },
            lfk_cabang_id: {
                required: true
            },
            ibadah_day: {
                required: true
            },
        },
        messages: {
            nama_ibadah: {
                required: 'Nama ibadah tidak boleh kosong'
            },
            ibadah_time_start: {
                required: 'Waktu mulai tidak boleh kosong'
            },
            ibadah_time_end: {
                required: 'Waktu selesai tidak boleh kosong'
            },
            lfk_kategori_gereja_id: {
                required: 'Kategori gereja tidak boleh kosong'
            },
            lfk_cabang_id: {
                required: 'Nama gereja tidak boleh kosong'
            },
            ibadah_day: {
                required: 'Hari tidak boleh kosong'
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })
}

