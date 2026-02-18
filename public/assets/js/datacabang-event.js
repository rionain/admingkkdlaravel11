const modalEvent = 'addEventData'
const formEvent = 'formEvent'

$('#' + modalEvent + ' #jam_event_selesai').bootstrapMaterialDatePicker({
    format: 'HH:mm',
    weekStart: 0,
    date: false,
    time: true
}).on('change', function(e, date) {
    // $('#' + modalEvent + ' #jam_event_mulai').bootstrapMaterialDatePicker('setMaxDate', date);
});

$('#' + modalEvent + ' #jam_event_mulai').bootstrapMaterialDatePicker({
    format: 'HH:mm',
    weekStart: 0,
    date: false,
    time: true
}).on('change', function(e, date) {
    // $('#' + modalEvent + ' #jam_event_selesai').bootstrapMaterialDatePicker('setMinDate', date);
});

$('#tambahEvent').on('click', function () {
    console.log('event')
    titleActionEvent('Form Tambah Event', base_url('admin-cabang/database/database-cabang/event'))
})

$('#' + modalEvent).on('hidden.bs.modal', function () {
    titleActionEvent('', base_url(''))
    tutupModalEvent(modalEvent, 'nama_event')
    tutupModalEvent(modalEvent, 'jenis_event')
    tutupModalEvent(modalEvent, 'tanggal_event_mulai')
    tutupModalEvent(modalEvent, 'tanggal_event_selesai')
    tutupModalEvent(modalEvent, 'jam_event_mulai')
    tutupModalEvent(modalEvent, 'jam_event_selesai')
    tutupModalEvent(modalEvent, 'catatan')
    tutupModalEvent(modalEvent, 'tujuan')
    tutupModalEvent(modalEvent, 'kuota_tersedia')
    tutupModalEvent(modalEvent, 'kehadiran')
    tutupModalEvent(modalEvent, 'lfk_status_event_id')
})

function editEvent(id) {
    titleActionEvent('Edit Event', base_url('admin-cabang/database/database-cabang/event/' + id))
    startloading('#' + modalEvent + ' .modal-dialog')
    var settings = {
        'url': base_url('api/v1/admin-cabang/database/database-cabang/event/' + id),
        'method': 'GET',
        'dataType': 'json',
        'timeout': timeOut()
    };

    $.ajax(settings).done(function (response) {
        setVal(modalEvent, 'nama_event', response.data.nama_event)
        setVal(modalEvent, 'jenis_event', response.data.jenis_event)
        setVal(modalEvent, 'tanggal_event_mulai', response.data.tanggal_event_mulai)
        setVal(modalEvent, 'tanggal_event_selesai', response.data.tanggal_event_selesai)
        setVal(modalEvent, 'jam_event_mulai', response.data.jam_event_mulai)
        setVal(modalEvent, 'jam_event_selesai', response.data.jam_event_selesai)
        setVal(modalEvent, 'catatan', response.data.catatan)
        setVal(modalEvent, 'tujuan', response.data.tujuan)
        setVal(modalEvent, 'kuota_tersedia', response.data.kuota_tersedia)
        setVal(modalEvent, 'kehadiran', response.data.kehadiran)
        setVal(modalEvent, 'lfk_status_event_id', response.data.lfk_status_event_id)
        stoploading('#' + modalEvent + ' .modal-dialog')
    }).
        fail(function (data, status, error) {
            stoploading('#' + modalEvent + ' .modal-dialog')
        });
}
function titleActionEvent(title, action) {
    $('#' + modalEvent + ' .modal-title').html(title)
    $('#' + modalEvent + ' #' + formEvent).attr('action', action)
}

function tutupModalEvent(modal, id) {
    $('#' + modal + ' #' + id).val('')
    $('#' + modal + ' #' + id).removeClass('is-invalid')
}
