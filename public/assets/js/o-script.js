$(document).on('click', '#btn-logout', function (e) {
    e.preventDefault();
    swal({
        title: 'Yakin akan keluar?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3366ff',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya',
        closeOnConfirm: false,
    },
        function (isConfirm) {
            if (isConfirm) {
                window.location.href = base_url('admin/logout');
            }
        });
});

function setVal(modal, id, value) {
    if (modal == '') {
        $('#' + id).val(value)
    } else {
        $('#' + modal + ' #' + id).val(value)
    }
}



function setHtmlVal(modal, id, value) {
    if (modal == '') {
        $('#' + id).val(value)
    } else {
        $('#' + modal + ' #' + id).html(value)
    }
}

function kosong() {
    return '<span class="badge badge-danger">Kosong</span>'
}

function badge(color, text) {
    return '<span class="badge badge-' + color + '">' + text + '</span>'
}

function hiddenModal(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
    $('#' + modal + ' #' + id +'-error').hide()

}

function base_url(data) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/';
    } else {
        var url = location.origin;
    }

    if (data == '' || data == null) {
        return url;
    } else {
        return url + '/' + data;
    }
}

function device_url(data) {
    // var url = 'https://bulibuli.argorudip.com/api';
    // var url = 'https://bulibuli.aigroo.com/api';
    var url = base_url('api');
    if (data == '' || data == null) {
        return url;
    } else {
        return url + '/' + data;
    }
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function confirmAlert(type, data, url, buttontxt) {
    let btnConfirmColor = ''
    if (type == 'warning') {
        btnConfirmColor = "#CD5C5C"
    } else if (type == 'info') {
        btnConfirmColor = '#3366ff'
    } else {
        btnConfirmColor = "#CD5C5C"
    }

    swal({
        title: data,
        type: type,
        showCancelButton: true,
        confirmButtonColor: btnConfirmColor,
        cancelButtonColor: "#d33",
        cancelButtonText: "Batal",
        confirmButtonText: buttontxt || "Simpan",
        closeOnConfirm: false,
    },
        function (isConfirm) {
            if (isConfirm) {
                window.location.href = url;
            }
        });
}

function delConf(link) {
    swal({
        title: "Yakin menghapus data?",
        text: "Data yang sudah terhapus tidak dapat dikembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#CD5C5C",
        cancelButtonColor: "#d33",
        cancelButtonText: "Batal",
        confirmButtonText: "Hapus",
        closeOnConfirm: false,
    },
        function (isConfirm) {
            if (isConfirm) {
                window.location.href = link;
            }
        });
}

function CekKonfirmasi(gagal, berhasil) {
    if (gagal != "") {
        swal({
            position: 'top-end',
            type: 'error',
            title: 'Gagal!',
            text: gagal,
            showConfirmButton: false,
            timer: 1500
        });
    }
    if (berhasil != "") {
        swal({
            position: 'top-end',
            type: 'success',
            title: 'Success!',
            text: berhasil,
            showConfirmButton: false,
            timer: 1500
        });
    }
}

function notFoundFitur() {
    swal({
        position: 'top-end',
        type: 'error',
        title: 'Maaf!',
        text: 'Menu belum tersedia',
        showConfirmButton: false,
        timer: 1500
    });
}

function badgeDanger(data) {
    if (data == '' || data == null) {
        return '<span class="badge badge-danger">Kosong</span>'
    } else {
        return '<span class="badge badge-danger">' + data + '</span>'
    }
}

function timeOut() {
    return 60000
}

function startloading(id) {
    $(id).ploading({
        action: 'show'
    })
}

function stoploading(id) {
    $(id).ploading({
        action: 'hide'
    })
}

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    // prefixkoin = 'Rp. ' + rupiah;
    prefixkoin = rupiah;
    return prefix == undefined ? prefixkoin : (rupiah ? '' + rupiah : '');
}

function smsTimeoutMessage() {
    return '<h3 class="text-center text-danger">Pastikan HP dalam kondisi menyala!<h3>'
}

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

function bold(text) {
    return '<b>' + text + '</b>'
}

function timePicker(id) {
    $('#' + id).bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });
}

function datePicker(id) {
    $('#' + id).bootstrapMaterialDatePicker({
        format: 'DD-MM-YYYY',
        // format: 'YYYY-MM-DD',
        clearButton: true,
        time: false
    });
}

//selectpicker

function spVal(id, val) {
    $('#' + id).val(val)
    $('#' + id).selectpicker('refresh');
}

function setSelect2(id) {
    $('#' + id).select2({ theme: 'bootstrap' })
}

function setValSelect2(modal, id, value) {
    if (modal == '') {
        $('#' + id).val(value).trigger('change')
    } else {
        $('#' + modal + ' #' + id).val(value).trigger('change')
    }
}

function removeSpace(val) {
    if (val) {
      const data = val.toString().split('.')
      let dt = ''
      data.map((value, index) => {
        dt = dt + value
      })
      return dt
    }
    return val
  }
