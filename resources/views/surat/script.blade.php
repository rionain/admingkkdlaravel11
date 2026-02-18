<script>
    $('#statusSurat').change((e) => {
        if ($('#statusSurat').val() == 5) {
            $('#form-group-alasan').css('display', 'inline')
        } else {
            $('#form-group-alasan').css('display', 'none')
        }

    });
    const modalBody = 'ubahStatus'
    // const modalDetailKop    = 'modalDetailKop'
    const formBody = 'formBody'

    $('#' + modalBody).on('hidden.bs.modal', function() {
        titleActionStatusSurat('', base_url(''))
        tutupModalStatusSurat(modalBody, 'nama_body')
        tutupModalStatusSurat(modalBody, 'html_body')
        $('#form-group-alasan').css('display', 'none')
    })

    function ubahStatus(id) {
        titleActionStatusSurat('Edit status', base_url('superadmin/administrasi/surat/surat-keterangan/ubah-status/' +
            id + '?'))
        startloading('#' + modalBody + ' .modal-dialog')

        let data = {};
        var settings = {
            'url': base_url('api/v1/superadmin/administrasi/surat/surat-keterangan/' + id),
            'method': 'GET',
            'dataType': 'json',
            'timeout': timeOut()
        };
        $.ajax(settings).done(function(response) {
            console.log(response)
            data = response;
            $.ajax({
                'url': base_url('api/v1/superadmin/setting/status-surat'),
                'method': 'GET',
                'dataType': 'json',
                'timeout': timeOut()
            }).done(function(response) {

                let html = '<option value="">- Pilih status surat -</option>';
                response.data.map((v, i) => {
                    if (data.jumlah_approval == 0) {
                        if (v.status_surat_id != 4 && v.status_surat_id != 3 && v
                            .status_surat_id != 2) {
                            html +=
                                `<option value="${v.status_surat_id}">${v.nama_status}</option>`;
                        }
                    } else if (data.jumlah_approval == 1) {
                        if (v.status_surat_id != 4 && v.status_surat_id != 3) {
                            html +=
                                `<option value="${v.status_surat_id}">${v.nama_status}</option>`;
                        }
                    } else if (data.jumlah_approval == 2) {
                        if (v.status_surat_id != 4) {
                            html +=
                                `<option value="${v.status_surat_id}">${v.nama_status}</option>`;
                        }
                    } else {
                        html +=
                            `<option value="${v.status_surat_id}">${v.nama_status}</option>`;
                    }
                });
                $('#statusSurat').html(html)
                console.log(data.data) //ini kadang kosoong
                setVal(modalBody, 'statusSurat', data.data.lfk_status_surat_id) //problem disini
                if (data.data.lfk_status_surat_id == 5) {
                    $('#form-group-alasan').css('display', 'inline')
                    $('#alasan').html(data?.data?.alasan)
                } else {
                    $('#form-group-alasan').css('display', 'none')
                }
                stoploading('#' + modalBody + ' .modal-dialog')
            }).
            fail(function(data, status, error) {
                stoploading('#' + modalBody + ' .modal-dialog')
            });
        }).
        fail(function(data, status, error) {
            stoploading('#' + modalBody + ' .modal-dialog')
        });
        // ----------------------------------------------------------------------------------------------

    }

    function titleActionStatusSurat(title, action) {
        $('#' + modalBody + ' .modal-title').html(title)
        $('#' + modalBody + ' #' + formBody).attr('action', action)
    }

    function tutupModalStatusSurat(modal, id) {
        $('#' + modal + ' #' + id).val('')
        $('#' + modal + ' #' + id).removeClass('is-invalid')
    }
</script>
<script>
    const modalSettingTemplate = 'settingTemplate'
    // const modalDetailKop    = 'modalDetailKop'
    const formSettingTemplate = 'formSettingTemplate'

    $('#' + modalSettingTemplate).on('hidden.bs.modal', function() {
        titleActionSettingTemplate('', base_url(''))
        tutupModalSettingTemplate(modalSettingTemplate, 'master_surat')
    });

    function showSettingTemplate(id) {
        titleActionSettingTemplate('Setting Master Surat', base_url(
            'superadmin/administrasi/surat/edit-master-surat/' + id))
        startloading('#' + modalSettingTemplate + ' .modal-dialog')

        let data = {};
        var settings = {
            'url': base_url('api/v1/superadmin/administrasi/surat/surat-keterangan/' + id),
            'method': 'GET',
            'dataType': 'json',
            'timeout': timeOut()
        };
        $.ajax(settings).done(function(response) {
            console.log(response)

            setVal(modalSettingTemplate, 'master_surat', response.data.lfk_template_master)
            stoploading('#' + modalSettingTemplate + ' .modal-dialog')
        }).
        fail(function(data, status, error) {
            stoploading('#' + modalSettingTemplate + ' .modal-dialog')
        });
    }

    function titleActionSettingTemplate(title, action) {
        $('#' + modalSettingTemplate + ' .modal-title').html(title)
        $('#' + modalSettingTemplate + ' #' + formSettingTemplate).attr('action', action)
    }

    function tutupModalSettingTemplate(modal, id) {
        $('#' + modal + ' #' + id).val('')
        $('#' + modal + ' #' + id).removeClass('is-invalid')
    }
</script>
