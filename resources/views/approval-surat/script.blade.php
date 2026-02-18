<script>
    const modalSurat = 'modalDemote'
    // const modalDetailKop    = 'modalDetailKop'
    const formSurat = 'formDemote'

    $('#' + modalSurat).on('hidden.bs.modal', function() {
        titleActionSurat('', base_url(''))
        tutupModalSurat(modalSurat, 'demote_reason')
    });

    function demote(id) {
        titleActionSurat('Demote surat', base_url(
            'approval/approve-surat/demote/' + id))
        startloading('#' + modalSurat + ' .modal-dialog')

        var settings = {
            'url': base_url('api/v1/approval/approve-surat/' + id),
            'method': 'GET',
            'dataType': 'json',
            'timeout': timeOut()
        };
        $.ajax(settings).done(function(response) {
            console.log(response)
            setVal(modalSurat, 'demote_reason', response.data.demote_reason)

            stoploading('#' + modalSurat + ' .modal-dialog')
        }).
        fail(function(data, status, error) {
            stoploading('#' + modalSurat + ' .modal-dialog')
        });
    }

    function titleActionSurat(title, action) {
        $('#' + modalSurat + ' .modal-title').html(title)
        $('#' + modalSurat + ' #' + formSurat).attr('action', action)
    }

    function tutupModalSurat(modal, id) {
        $('#' + modal + ' #' + id).val('')
        $('#' + modal + ' #' + id).removeClass('is-invalid')
    }
</script>
