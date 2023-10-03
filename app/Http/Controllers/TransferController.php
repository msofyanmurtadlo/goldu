<?php

namespace App\Http\Controllers;

use App\Models\Network;
use App\Models\User;
use Illuminate\Http\Request;


class TransferController extends Controller
{
    public function index()
    {
        $users = User::where('ballance', '!=', 0)
            ->with(['networkBallances.network'])->paginate(10);

        $network = Network::all();
        return view('transfers.index', compact('users', 'network'));
    }
    public function now(User $user)
    {
        $user->load('networkBallances.network');
        return view('transfers.now', compact('user'));
    }
}
