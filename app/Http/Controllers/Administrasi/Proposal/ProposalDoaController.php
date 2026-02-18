<?php

namespace App\Http\Controllers\Administrasi\Proposal;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\StatusProposal;
use Illuminate\Http\Request;

class ProposalDoaController extends Controller
{
    public function proposal_doa()
    {
        $proposal = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 4])->orderBy('created_date', 'DESC')->get();
        $data = [
            'title'             => 'Proposal Doa',
            'menu_aktif'        => 'proposal_doa',
            'proposal'          => $proposal,
            'status_proposal'   => StatusProposal::where(['active' => 1, 'deleted' => '0',])->get(),
        ];
        return view('proposal.proposal-doa', $data);
    }





































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_proposal_doa_all()
    {
        $proposal_doa = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 4])->with('jenis_proposal', 'status_proposal', 'user')->get();

        return response()->json([
            'status' => true,
            'data' => $proposal_doa,
        ]);
    }
    public function api_proposal_doa_detail($proposal_doa_id)
    {
        $proposal_doa = Proposal::where('proposal_id', $proposal_doa_id)->where(['deleted' => '0', 'lfk_jenis_proposal_id' => 4])->with('jenis_proposal', 'status_proposal', 'user')->first();

        if (!$proposal_doa) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $proposal_doa,
            ]);
        }
    }
}
