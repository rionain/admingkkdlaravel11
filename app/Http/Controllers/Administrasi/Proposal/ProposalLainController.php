<?php

namespace App\Http\Controllers\Administrasi\Proposal;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\StatusProposal;
use Illuminate\Http\Request;

class ProposalLainController extends Controller
{
    public function proposal_lain()
    {
        $proposal = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 5])->orderBy('created_date', 'DESC')->get();
        $data = [
            'title'             => 'Proposal Lain',
            'menu_aktif'        => 'proposal_lain',
            'proposal'          => $proposal,
            'status_proposal'   => StatusProposal::where(['active' => 1, 'deleted' => '0',])->get(),
        ];
        return view('proposal.proposal-lain', $data);
    }





































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_proposal_lain_all()
    {
        $proposal_lain = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 5])->with('jenis_proposal', 'status_proposal', 'user')->get();

        return response()->json([
            'status' => true,
            'data' => $proposal_lain,
        ]);
    }
    public function api_proposal_lain_detail($proposal_lain_id)
    {
        $proposal_lain = Proposal::where('proposal_id', $proposal_lain_id)->where(['deleted' => '0', 'lfk_jenis_proposal_id' => 5])->with('jenis_proposal', 'status_proposal', 'user')->first();

        if (!$proposal_lain) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $proposal_lain,
            ]);
        }
    }
}
