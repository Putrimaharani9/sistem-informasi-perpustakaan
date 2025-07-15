<?php

namespace App\Http\Controllers;

use App\DataTables\LoansDataTable;
use App\DataTables\VisitsDataTable;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(LoansDataTable $loansDataTable, VisitsDataTable $visitsDataTable)
    {
        if (auth()->user()->hasRole('member')) {
            return $this->indexMember($loansDataTable, $visitsDataTable);
        }

        $totalDays = Carbon::now()->daysInMonth;
        $currentMonth = date('m');
        $currentYear = date('Y');

        $days = range(1, $totalDays);

        $loans = DB::table('loans')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as total'))
            ->whereMonth('created_at', '=', $currentMonth) // This month
            ->whereYear('created_at', '=', $currentYear) // This year
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'), 'asc')
            ->get()
            ->keyBy('day');

        $visits = DB::table('visits')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as total'))
            ->whereMonth('created_at', '=', $currentMonth) // This month
            ->whereYear('created_at', '=', $currentYear) // This year
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'), 'asc')
            ->get()
            ->keyBy('day');

        $loansResult = [];

        foreach ($days as $date) {
            $loansResult[] = [
                'day' => $date,
                'total' => isset($loans[$date]) ? $loans[$date]->total : 0,  // Jika tidak ada data, set total menjadi 0
            ];
        }

        $visitsResult = [];

        foreach ($days as $date) {
            $visitsResult[] = [
                'day' => $date,
                'total' => isset($loans[$date]) ? $loans[$date]->total : 0,  // Jika tidak ada data, set total menjadi 0
            ];
        }

        $data = new Fluent([
            'members_count' => User::role('member')->count(),
            'books_count' => Book::count(),
            'copies_count' => BookCopy::count(),
            'staffs_count' => Role::where('name', 'staff')->first()->users->count(),
            'loan_data' => collect($loansResult)->pluck('total')->toArray(),
            'loan_labels' => $days,
            'visits_count' => Visit::whereDate('created_at', now()->toDateString())->count(),
            'visit_data' => collect($visitsResult)->pluck('total')->toArray(),
            'visit_labels' => $days,
        ]);

        $pageTitle = 'Dashboard';
        return view('index', compact('data', 'pageTitle'));
    }

    /**
     * Index page for member
     */
    public function indexMember(LoansDataTable $loansDataTable, VisitsDataTable $visitsDataTable)
    {
        $pageTitle = 'Beranda';
        $active_loans = auth()->user()->active_loans;

        $data = new Fluent([
            'active_loans' => $active_loans,
            'active_loans_count' => $active_loans->count(),
            'need_return_count' => DB::select("SELECT COUNT(*) AS total FROM loans WHERE member_id = ? AND is_returned = 0 AND return_date <= CURDATE()", [auth()->user()->id])[0]->total,
            'visits_count' => DB::select("SELECT COUNT(*) AS total FROM visits WHERE member_id = ? AND DATE(created_at) BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND LAST_DAY(CURDATE())", [auth()->user()->id])[0]->total,
        ]);

        return view('index-member', [
            'data' => $data,
            'pageTitle' => $pageTitle,
            'loansDataTable' => $loansDataTable->with(['minifiedAjax' => route('dashboard.loans')])->html(),
            'visitsDataTable' => $visitsDataTable->with(['minifiedAjax' => route('dashboard.visits')])->html(),
        ]);
    }

    /**
     * Get loans datatable ajax
     */
    public function getLoans(LoansDataTable $loansDataTable)
    {
        return $loansDataTable->with(['member_id' => auth()->user()->id])->render();
    }

    /**
     * Get visits datattable ajax
     */
    public function getVisits(VisitsDataTable $visitsDataTable)
    {
        return $visitsDataTable->with(['member_id' => auth()->user()->id])->render();
    }
}
