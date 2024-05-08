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
            $countPengajuan = Reimbursement::where('user_id', Auth::user()->id)->count();
            $countPendingPengajuan = Reimbursement::where('user_id', Auth::user()->id)->where('status', 'pending')->count();
            $countTerimaPengajuan = Reimbursement::where('user_id', Auth::user()->id)->where('status', 'terima')->count();
            $countTolakPengajuan = Reimbursement::where('user_id', Auth::user()->id)->where('status', 'tolak')->count();
        } else {
            $countPengajuan = Reimbursement::count();
            $countPendingPengajuan = Reimbursement::where('status', 'pending')->count();
            $countTerimaPengajuan = Reimbursement::where('status', 'terima')->count();
            $countTolakPengajuan = Reimbursement::where('status', 'tolak')->count();
        }

        return view('pages.panel.dashboard.dashboard', compact(['countPengajuan', 'countPendingPengajuan', 'countTerimaPengajuan', 'countTolakPengajuan']));
    }
}
