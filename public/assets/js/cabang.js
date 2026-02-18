const modalCabang = 'addCabangData'
const formCabang = 'formCabang'


$(function(){
    cabangValidation(formCabang)
})

$('#tambahCabang').on('click', function () {
    titleActionCabang('Form Tambah Cabang', base_url('superadmin/database/database-cabang/cabang'))
})

$('#' + modalCabang).on('hidden.bs.modal', function () {
    titleActionCabang('', base_url(''))
    tutupModalCabang(modalCabang, 'nama_cabang')
    tutupModalCabang(modalCabang, 'info_detail')
    tutupModalCabang(modalCabang, 'lfk_kategori_gereja_id')
    tutupModalCabang(modalCabang, 'lfk_kategori_gereja_id')
    $('#'+modalCabang+' #nama_cabang'+'-error').hide()
    $('#'+modalCabang+' #info_detail'+'-error').hide()
    $('#'+modalCabang+' #lfk_kategori_gereja_id'+'-error').hide()
    $('.selectpicker').selectpicker('refresh')
})

function editCabang(id) {
    titleActionCabang('Edit Cabang', base_url('superadmin/database/database-cabang/cabang/' + id))
    startloading('#' + modalCabang + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/database/database-cabang/cabang/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalCabang, 'nama_cabang', response.data.nama_cabang)
        setVal(modalCabang, 'info_detail', response.data.info_detail)
        setVal(modalCabang, 'lfk_kategori_gereja_id', response.data.lfk_kategori_gereja_id)
        $('.selectpicker').selectpicker('refresh')
        stoploading('#' + modalCabang + ' .modal-dialog')
    }).
    fail(function (data, status, error) {
        stoploading('#' + modalCabang + ' .modal-dialog')
    });
}
function titleActionCabang(title, action) {
    $('#' + modalCabang + ' .modal-title').html(title)
    $('#' + modalCabang + ' #' + formCabang).attr('action', action)
}

function tutupModalCabang(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}

function cabangValidation(id){
    $('#'+id).validate({
        rules: {
            nama_cabang: {
                required: true
            },
            lfk_kategori_gereja_id: {
                required: true
            },
        },
        messages: {
            nama_cabang: {
                required: 'Nama cabang tidak boleh kosong'
            },
            lfk_kategori_gereja_id: {
                required: 'Kategori gereja tidak boleh kosong'
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
