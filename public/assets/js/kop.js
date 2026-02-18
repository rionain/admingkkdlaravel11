const modalKop = 'kopModal'
const modalDetailKop = 'modalDetailKop'
const formKop = 'formKop'

$(function () {
    KopValidation(formKop)
})

$(":file").filestyle({ buttonName: "btn-primary" });

$('#tambahKop').click(function () {
    console.log('s')
    // $('#nama_kop_surat').enabled()
    titleAction('Form Tambah Kop', base_url('superadmin/pengaturan/kop-surat'))
})

$('#' + modalKop).on('hidden.bs.modal', function () {
    titleAction('', base_url(''))
    // $('#nama_kop_surat').disabled()
    hiddenModal(modalKop, 'nama_kop_surat')
    hiddenModal(modalKop, 'fieldTitleHeader')
    hiddenModal(modalKop, 'fieldHeaderDescription')
})

function editKop(id) {
    titleAction('Edit Mode Setting', base_url('superadmin/pengaturan/kop-surat/' + id))
    startloading('#' + modalKop + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/superadmin/pengaturan/kop-surat/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };
    $.ajax(settings).done(function (response) {
        setVal(modalKop, 'nama_kop_surat', response.data.nama_kop_surat)
        setVal(modalKop, 'fieldTitleHeader', response.data.title)
        setVal(modalKop, 'fieldHeaderDescription', response.data.deskripsi)
        stoploading('#' + modalKop + ' .modal-dialog')
    }).
        fail(function (data, status, error) {
            console.log('data: ' + data)
            console.log('status: ' + status)
            console.log('error: ' + error)
            if (status == 'timeout') {
                CekKonfirmasi('Timeout!', '')
            } else if (data.responseJSON.status == false) {
                CekKonfirmasi(data.responseJSON.message, '')
            }
            stoploading('#' + modalKop + ' .modal-dialog')
        });
}

function deleteKop(id) {
    delConf(base_url('admin/mode_setting/delete/' + id))
}


function titleAction(title, action) {
    $('#' + modalKop + ' .modal-title').html(title)
    $('#' + modalKop + ' #' + formKop).attr('action', action)
}

function KopValidation(id) {
    $('#' + id).validate({
        rules: {
            time: {
                required: true
            },
            active: {
                required: true
            }
        },
        messages: {
            time: {
                required: 'Waktu tidak boleh kosong'
            },
            active: {
                required: 'Status aktif tidak boleh kosong'
            }
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
