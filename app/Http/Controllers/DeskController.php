<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use App\Http\Requests\StoreDeskRequest;
use App\Models\User;
use Carbon\Carbon;

class DeskController extends Controller
{

    public function index()
    {
        $cur = now();
        $user = auth()->user();
        $desks = Desk::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('welcome', compact('desks', 'user', 'cur'));
    }


    public function create()
    {
        $user = auth()->user();
        return view('create', compact('user'));
    }


    public function store(StoreDeskRequest $request)
    {
        $data = $request->validated();
        Desk::firstOrCreate($data);
        return redirect()->route('main');

    }


    public function destroy(Desk $desk)
    {
        $desk->delete();
        return redirect()->route('main');
    }
}
