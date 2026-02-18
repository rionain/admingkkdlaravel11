<div id="modalProposal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formProposal" action="{{ url('', []) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Status Proposal</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="foto_event" class="control-label">Status proposal</label>
                        <select name="status_proposal" id="status_proposal" class="form-control">
                            <option value="">Pilih status</option>
                            @foreach ($status_proposal as $item)
                                <option value="{{ $item->status_proposal_id }}">
                                    {{ $item->status_proposal }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="display: none" id="alasan-form">
                        <label for="foto_event" class="control-label">Alasan</label>
                        <textarea name="alasan" id="alasan" cols="5" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! modalFooterZircos() !!}
                </div>
            </form>
        </div>
    </div>
</div>
