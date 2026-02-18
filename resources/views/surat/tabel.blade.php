{{-- <div class="table-responsive"> --}}
    <table class="{{ styletable() }}" id="datatable-suratketerangan">
        <thead>
            <tr>
                <th class='text-center table-number'>No</th>
                <th class='text-center'>Nama Surat</th>
                <th class='text-center'>Perihal</th>
                <th class='text-center'>Requester</th>
                <th class='text-center'>Status Surat</th>
                <th class='text-center'>Alasan</th>
                <th class='text-center'>Status Template</th>
                <th class='text-center'>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($request_surat as $key => $item)
                <tr class="">
                    <td class="text-center">{{ ++$key }}</td>
                    <td>{{ $item->nama_surat }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td>{{ $item->user->nama }}</td>
                    <td>{{ $item->status_surat->nama_status }}</td>
                    <td>
                        @if ($item->demote_reason != null)
                            {{ $item->demote_reason }}
                        @else
                            <span class="badge badge-danger">Kosong</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->lfk_template_master)
                            <span class="badge badge-success">Sudah ada template</span>
                        @else
                            <span class="badge badge-warning">Belum ada template</span>

                        @endif
                    </td>
                    <td class="actions">
                        <a href="{{ url('superadmin/administrasi/surat/lihat/' . $item->surat_id, []) }}"
                            class="btn btn-primary" style="margin-bottom: 5px;" target="_blank"><i class="fa fa-eye"></i>
                            Lihat</a>
                        @if ($item->lfk_status_surat_id == 6)
                            <a href="{{ url('superadmin/administrasi/surat/pdf/' . $item->surat_id, []) }}"
                                class="btn btn-primary" style="margin-bottom: 5px;"><i class="fa fa-download"></i>
                                Download
                            </a>
                        @else
                            @if ($item->lfk_template_master)
                                <button class="btn btn-success" style="margin-bottom: 5px;" data-toggle="modal" data-target="#ubahStatus"
                                    onclick="ubahStatus('{{ $item->surat_id }}')"><i class="fa fa-edit"></i>
                                    Status</button>
                            @endif
                            <button class="btn btn-success" style="margin-bottom: 5px;" data-toggle="modal" data-target="#settingTemplate"
                                onclick="showSettingTemplate('{{ $item->surat_id }}')"><i class="fa fa-edit"></i>
                                Template master</button>
                        @endif
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
{{-- </div> --}}
