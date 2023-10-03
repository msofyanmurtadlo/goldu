<?php

namespace App\Http\Controllers;

use App\Models\link;
use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class LinkController extends Controller
{
    public function smartlinks(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $smartlinksQuery = link::query();

        if (auth()->check() && !auth()->user()->is_admin) {
            $smartlinksQuery->where('user_id', auth()->user()->id);
        }

        if ($startDate && $endDate) {
            // Parse the start and end date using Carbon
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();

            $smartlinksQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $smartlinks = $smartlinksQuery->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(10);
        $network = Network::get();
        $filteredCount = $smartlinks->count();
        return view('links.smartlinks', compact('smartlinks', 'filteredCount', 'network'));
    }
    public function destroy(Link $link)
    {
        $link->delete();
        return response()->json(['message' => 'Pengguna berhasil dihapus.']);
    }
}
