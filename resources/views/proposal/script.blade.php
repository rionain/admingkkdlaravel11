<script>
    const modalProposal = 'modalProposal'
    const formProposal = 'formProposal'

    $('#status_proposal').change((e) => {
        const status_proposal = $('#status_proposal').val();
        if (status_proposal == 2) {
            $('#alasan-form').css('display', 'inline');
        } else {
            $('#alasan-form').css('display', 'none');
        }
    })

    $('#tambahProposal').on('click', function() {
        titleAction('Form Tambah Proposal', base_url(
            'superadmin/administrasi/pengaturan/Proposal-surat/tambah-Proposal'))
    })

    $('#' + modalProposal).on('hidden.bs.modal', function() {
        titleAction('', base_url(''))
        tutupModal(modalProposal, 'status_proposal')
        $('#alasan-form').css('display', 'none');
    })

    function editProposal(id) {
        titleAction('Edit Proposal Surat', base_url('superadmin/administrasi/proposal/' + id))
        startloading('#' + modalProposal + ' .modal-dialog')
        var settings = {
            'url': base_url('api/v1/superadmin/administrasi/proposal/' + id),
            'method': 'GET',
            'dataType': 'json',
            'timeout': timeOut()
        };

        $.ajax(settings).done(function(response) {
            setVal(modalProposal, 'status_proposal', response.data.lfk_status_proposal_id)
            setVal(modalProposal, 'alasan', response.data.demote_reason)
            if (response.data.lfk_status_proposal_id == 2) {
                $('#alasan-form').css('display', 'inline');
            } else {
                $('#alasan-form').css('display', 'none');
            }

            stoploading('#' + modalProposal + ' .modal-dialog')
        }).
        fail(function(data, status, error) {
            // console.log('data: '+data)
            // console.log('status: '+status)
            // console.log('error: '+error)
            // if(status == 'timeout'){
            //     CekKonfirmasi('Timeout!', '')
            // } else if(data.responseJSON.status == false){
            //     CekKonfirmasi(data.responseJSON.message, '')
            // }
            stoploading('#' + modalProposal + ' .modal-dialog')
        });
    }

    function titleAction(title, action) {
        $('#' + modalProposal + ' .modal-title').html(title)
        $('#' + modalProposal + ' #' + formProposal).attr('action', action)
    }

    function tutupModal(modal, id) {
        $('#' + modal + ' #' + id).val('')
        $('#' + modal + ' #' + id).removeClass('is-invalid')
    }
</script>
