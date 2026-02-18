<div id="ubahStatus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <form action="{{ url('superadmin/administrasi/surat/ubah-status/') }}" method="POST" id="formBody">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Ubah status</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="statusSurat">Status Surat</label><br>
                        <select id="statusSurat" name="statusSurat" class="form-control">
                            <option value="">- Pilih status surat -</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none" id="form-group-alasan">
                        <label for="alasan">Alasan</label><br>
                        <textarea name="alasan" id="alasan" cols="5" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! modalFooterZircos() !!}
                </div>
            </div>
        </form>
    </div>
</div>
<div id="settingTemplate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form action="{{ url('superadmin/administrasi/surat/surat-keterangan/edit-master-surat/') }}" method="POST"
            id="formSettingTemplate">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Master surat</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="master_surat" >Master Surat</label><br>
                        <select id="master_surat" name="master_surat" class="form-control">
                            <option value="">- Pilih master surat -</option>
                            @foreach ($master_surat as $item)
                                <option value="{{ $item->template_master_id }}">{{ $item->nama_master }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! modalFooterZircos() !!}
                </div>
            </div>
        </form>
    </div>
</div>
