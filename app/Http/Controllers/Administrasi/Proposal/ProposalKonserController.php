<?php

namespace App\Http\Controllers\Administrasi\Proposal;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\StatusProposal;
use Illuminate\Http\Request;

class ProposalKonserController extends Controller
{
    public function proposal_konser()
    {
        $proposal = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 3])->orderBy('created_date', 'DESC')->get();
        $data = [
            'title'             => 'Proposal Konser',
            'menu_aktif'        => 'proposal_konser',
            'proposal'          => $proposal,
            'status_proposal'   => StatusProposal::where(['active' => 1, 'deleted' => '0',])->get(),
        ];
        return view('proposal.proposal-konser', $data);
    }


























    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_proposal_konser_all()
    {
        $proposal_konser = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 3])->with('jenis_proposal', 'status_proposal', 'user')->get();

        return response()->json([
            'status' => true,
            'data' => $proposal_konser,
        ]);
    }
    public function api_proposal_konser_detail($proposal_konser_id)
    {
        $proposal_konser = Proposal::where('proposal_id', $proposal_konser_id)->where(['deleted' => '0', 'lfk_jenis_proposal_id' => 3])->with('jenis_proposal', 'status_proposal', 'user')->first();

        if (!$proposal_konser) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $proposal_konser,
            ]);
        }
    }
}
