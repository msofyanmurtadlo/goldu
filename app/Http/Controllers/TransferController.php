<?php

namespace App\Http\Controllers;

use App\Models\Network;
use App\Models\User;
use Illuminate\Http\Request;


class TransferController extends Controller
{
    public function index()
    {
        $search = request('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('username', 'like', "%{$search}%");
        })
            ->whereHas('networkBallances', function ($query) {
                $query->where('balance', '>', 0);
            })
            ->with(['networkBallances.network'])
            ->orderBy('created_at', 'desc')
            ->paginate(10)->onEachSide(0);

        $network = Network::all();
        return view('transfers.index', compact('users', 'network'));
    }
    public function now(User $user)
    {
        $user->load(['networkBallances.network', 'bank']);
        return view('transfers.now', compact('user'));
    }
}
