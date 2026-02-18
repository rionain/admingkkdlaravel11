<?php

namespace App\Http\Controllers\Administrasi\Proposal;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\StatusProposal;
use Illuminate\Http\Request;

class ProposalEventController extends Controller
{
    public function proposal_event()
    {
        $proposal = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 1])->orderBy('created_date', 'DESC')->get();
        $data = [
            'title'             => 'Proposal Event',
            'menu_aktif'        => 'proposal_event',
            'proposal'          => $proposal,
            'status_proposal'   => StatusProposal::where(['active' => 1, 'deleted' => '0',])->get(),
        ];
        return view('proposal.proposal-event', $data);
    }

    public function edit_status_proposal($proposal_id)
    {
        $value = (object) request()->validate([
            'status_proposal'   => 'required',
        ]);
        if ($value->status_proposal == 2) {
            request()->validate([
                'alasan'   => 'required',
            ]);
        }

        $proposal = Proposal::where(['proposal_id' => $proposal_id, 'deleted' => '0'])->first();
        if (!$proposal) {
            return redirect()->back()->withInput()->with('gagal', 'Data event tidak ditemukan');
        }
        $proposal->lfk_status_proposal_id = $value->status_proposal;

        if ($value->status_proposal == 2) {
            $proposal->demote_reason = request('alasan');
        } elseif ($value->status_proposal == 3) {
            $proposal->approval_date = date('Y-m-d');
        }

        $cek = $proposal->save();
        if (!$cek) {
            return redirect()->back()->withInput()->with('gagal', 'Gagal mengubah data');
        }

        return redirect()->back()->withInput()->with('berhasil', 'Berhasil mengubah data');
    }





































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_proposal_all()
    {
        $proposal = Proposal::where(['deleted' => '0'])->with('jenis_proposal', 'status_proposal', 'user')->get();

        return response()->json([
            'status' => true,
            'data' => $proposal,
        ]);
    }
    public function api_proposal_detail($proposal_id)
    {
        $proposal = Proposal::where('proposal_id', $proposal_id)->where(['deleted' => '0'])->with('jenis_proposal', 'status_proposal', 'user')->first();

        if (!$proposal) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $proposal,
            ]);
        }
    }
}
