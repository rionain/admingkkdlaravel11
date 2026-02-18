<div id="modalDemote" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Ajukan Surat</h4>
            </div>
            <form action="{{ url('approval/approve-surat/surat-custom') }}" method="POST"
                enctype="multipart/form-data" id="formDemote">
                @csrf
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="demote_reason" class="control-label">Alasan</label>
                        <input type="text" class="form-control" id="demote_reason" name="demote_reason"
                            placeholder="Demote.." required value="{{ old('demote_reason') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    {!! modalFooterZircos() !!}
                </div>
            </form>

        </div>
    </div>
</div>
