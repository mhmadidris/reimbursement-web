<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('staff')) {
            $countPengajuan = Reimbursement::where('user_id', Auth::user()->id)
                ->count();
            $countPendingPengajuan = Reimbursement::where('user_id', Auth::user()->id)
                ->where('status', 'pending')
                ->join('reimbursement_logs', 'reimbursements.id', 'reimbursement_logs.reimbursement_id')
                ->count();
            $countTerimaPengajuan = Reimbursement::where('user_id', Auth::user()->id)
                ->where('status', 'terima')
                ->join('reimbursement_logs', 'reimbursements.id', 'reimbursement_logs.reimbursement_id')
                ->count();
            $countTolakPengajuan = Reimbursement::where('user_id', Auth::user()->id)
                ->where('status', 'tolak')
                ->join('reimbursement_logs', 'reimbursements.id', 'reimbursement_logs.reimbursement_id')
                ->count();
        } else {
            $countPengajuan = Reimbursement::count();
            $countPendingPengajuan = Reimbursement::where('status', 'pending')
                ->join('reimbursement_logs', 'reimbursements.id', 'reimbursement_logs.reimbursement_id')
                ->count();

            $countTerimaPengajuan = Reimbursement::where('status', 'terima')
                ->join('reimbursement_logs', 'reimbursements.id', 'reimbursement_logs.reimbursement_id')
                ->count();
            $countTolakPengajuan = Reimbursement::where('status', 'tolak')
                ->join('reimbursement_logs', 'reimbursements.id', 'reimbursement_logs.reimbursement_id')
                ->count();
        }

        return view('pages.panel.dashboard.dashboard', compact(['countPengajuan', 'countPendingPengajuan', 'countTerimaPengajuan', 'countTolakPengajuan']));
    }
}