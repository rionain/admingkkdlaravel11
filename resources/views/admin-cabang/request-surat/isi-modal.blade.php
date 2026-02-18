<div id="modalSurat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Ajukan Surat</h4>
            </div>
            <form action="{{ url('admin-cabang/request-surat/surat-keterangan') }}" method="POST"
                enctype="multipart/form-data" id="formSurat">
                @csrf
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nama_surat" class="control-label">Nama Surat</label>
                        <input type="text" class="form-control" id="nama_surat" name="nama_surat" placeholder="Nama.."
                            required value="{{ old('nama_surat') }}">
                    </div>
                    <div class="form-group">
                        <label for="perihal" class="control-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal.."
                            required value="{{ old('perihal') }}">
                    </div>
                    <div class="form-group">
                        <label for="nama_diajukan" class="control-label">Nama Diajukan</label>
                        <input type="text" class="form-control" id="nama_diajukan" name="nama_diajukan"
                            placeholder="Nama Diajukan.." required value="{{ old('nama_diajukan') }}">
                    </div>
                    <div class="form-group">
                        <label for="email_diajukan" class="control-label">Email Diajukan</label>
                        <input type="email" class="form-control" id="email_diajukan" name="email_diajukan"
                            placeholder="Email Diajukan.." required value="{{ old('email_diajukan') }}">
                    </div>
                    <div class="form-group">
                        <label for="no_telp_diajukan" class="control-label">No Telp
                            Diajukan</label>
                        <input type="text" class="form-control" id="no_telp_diajukan" name="no_telp_diajukan"
                            placeholder="No Telp Diajukan.." required value="{{ old('no_telp_diajukan') }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat_diajukan" class="control-label">Alamat
                            Diajukan</label>
                        <input type="text" class="form-control" id="alamat_diajukan" name="alamat_diajukan"
                            placeholder="Alamat Diajukan.." required value="{{ old('alamat_diajukan') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Ajukan</button>
                </div>
            </form>

        </div>
    </div>
</div>
