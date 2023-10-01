<?php

namespace App\Http\Controllers;

use App\Models\Traffic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TrafficController extends Controller
{
    public function index(Request $request)
    {

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $trafficsQuery = Traffic::query();

        if (auth()->check() && !auth()->user()->is_admin) {
            $trafficsQuery->where('user_id', auth()->user()->id);
        }

        if ($startDate && $endDate) {
            // Parse the start and end date using Carbon
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();

            $trafficsQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $traffics = $trafficsQuery->orderBy('created_at', 'desc')
            ->with('user', 'network')
            ->paginate(10);
        $filteredCount = $traffics->count();
        return view('traffics.index', compact('traffics', 'filteredCount'));
    }
}
