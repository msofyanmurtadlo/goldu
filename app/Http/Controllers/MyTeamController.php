<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MyTeamController extends Controller
{
    public function index()
    {
        $search = request('search');
        $myteams = User::when(auth()->check(), function ($query) use ($search) {
            $query->where('referal', auth()->user()->username);

            if ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('username', 'like', "%{$search}%");
                });
            }
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('myteams.index', compact('myteams'));
    }
}
