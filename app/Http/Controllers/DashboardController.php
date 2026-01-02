<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;
use App\Models\Finance;
use App\Models\Wishlist;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        /* =========================
           RINGKASAN DASHBOARD
        ========================== */

        $totalSchedule = Schedule::where('user_id', $userId)->count();

        $totalIncome = Finance::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = Finance::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        $totalWishlist = Wishlist::where('user_id', $userId)->count();

        /* =========================
           UPCOMING SCHEDULE
        ========================== */

        $upcomingSchedules = Schedule::where('user_id', $userId)
            ->orderBy('date', 'asc')
            ->take(5)
            ->get();

        /* PRIORITY WISHLIST= */
        $priorityWishlist = Wishlist::where('user_id', $userId)
            ->orderBy('priority', 'asc')
            ->take(5)
            ->get();

        /*DATA GRAFIK KEUANGAN */
        $financeChart = Finance::select(
                DB::raw('MONTH(date) as month'),
                DB::raw("SUM(CASE WHEN type='income' THEN amount ELSE 0 END) as income"),
                DB::raw("SUM(CASE WHEN type='expense' THEN amount ELSE 0 END) as expense")
            )
            ->where('user_id', $userId)
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'month'   => date('F', mktime(0, 0, 0, $item->month, 1)),
                    'income' => (int) $item->income,
                    'expense'=> (int) $item->expense,
                ];
            });

        return view('dashboard.index', compact(
            'totalSchedule',
            'totalIncome',
            'totalExpense',
            'totalWishlist',
            'upcomingSchedules',
            'priorityWishlist',
            'financeChart'
        ));
    }
}
