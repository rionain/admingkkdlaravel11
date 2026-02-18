const modalIbadah = 'addIbadahData'
const formIbadah = 'formIbadah'

$(function(){
    IbadahValidation(formIbadah)

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
})

$('#tambahIbadah').on('click', function () {
    titleActionIbadah('Form Tambah Ibadah', base_url('admin-cabang/database/database-cabang/ibadah'))
})

$('#' + modalIbadah).on('hidden.bs.modal', function () {
    titleActionIbadah('', base_url(''))
    hiddenModal(modalIbadah, 'nama_ibadah')
    hiddenModal(modalIbadah, 'ibadah_time_start')
    hiddenModal(modalIbadah, 'ibadah_time_end')
    hiddenModal(modalIbadah, 'kapasitasIbadah')
    hiddenModal(modalIbadah, 'wilayahLayanan')
    hiddenModal(modalIbadah, 'ibadah_day')
    setVal(modalIbadah, 'kapasitasIbadah', '0')
    setValSelect2(modalIbadah,'ibadah_day', '')

})

function editIbadah(id) {
    titleActionIbadah('Edit Ibadah', base_url('admin-cabang/database/database-cabang/ibadah/' + id));
    startloading('#' + modalIbadah + ' .modal-dialog');
    var settings = {
        'url': base_url('api/v1/admin-cabang/database/database-cabang/ibadah/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        console.log(response)
        setVal(modalIbadah, 'nama_ibadah', response.data.nama_ibadah)
        setVal(modalIbadah, 'ibadah_time_start', response.data.ibadah_time_start)
        setVal(modalIbadah, 'ibadah_time_end', response.data.ibadah_time_end)
        setVal(modalIbadah, 'wilayahLayanan', response.data.cabang.cabang_id)
        setVal(modalIbadah, 'kapasitasIbadah', response.data.kapasitas_ibadah)
        setVal(modalIbadah, 'ibadah_day', response.data.ibadah_day)
        setVal(modalIbadah, 'notes', response.data.notes)
        if ((response.data.active != 1 && $('#activeIbadah').is(':checked'))||(response.data.active==1 && !$('#activeIbadah').is(':checked'))) {
            $('#activeIbadah').click();
        }
        setVal(modalIbadah, 'activeIbadah', response.data.active)
        $('.selectpicker').selectpicker('refresh')
        stoploading('#' + modalIbadah + ' .modal-dialog')
    }).
    fail(function (data, status, error) {
        stoploading('#' + modalIbadah + ' .modal-dialog')
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
