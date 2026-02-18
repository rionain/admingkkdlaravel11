<?php

namespace App\Http\Controllers\Administrasi\Proposal;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\StatusProposal;
use Illuminate\Http\Request;

class ProposalSeminarController extends Controller
{
    public function proposal_seminar()
    {
        $proposal = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 2])->orderBy('created_date', 'DESC')->get();
        $data = [
            'title'             => 'Proposal Seminar',
            'menu_aktif'        => 'proposal_seminar',
            'proposal'          => $proposal,
            'status_proposal'   => StatusProposal::where(['active' => 1, 'deleted' => '0',])->get(),
        ];
        return view('proposal.proposal-seminar', $data);
    }



































    // ------------------------------------------------------------------------
    // API
    // ------------------------------------------------------------------------
    public function api_proposal_seminar_all()
    {
        $proposal_seminar = Proposal::where(['deleted' => '0', 'lfk_jenis_proposal_id' => 2])->with('jenis_proposal', 'status_proposal', 'user')->get();

        return response()->json([
            'status' => true,
            'data' => $proposal_seminar,
        ]);
    }
    public function api_proposal_seminar_detail($proposal_seminar_id)
    {
        $proposal_seminar = Proposal::where('proposal_id', $proposal_seminar_id)->where(['deleted' => '0', 'lfk_jenis_proposal_id' => 2])->with('jenis_proposal', 'status_proposal', 'user')->first();

        if (!$proposal_seminar) {
            return response()->json([
                'status' => false,
                'error' => 'Data tidak ditemukan',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $proposal_seminar,
            ]);
        }
    }
}
