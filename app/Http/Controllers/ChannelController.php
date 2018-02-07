<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;

class ChannelController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function create()
    {
        return view('channel.create');
    }

    public function store()
    {
        // dd('mall');
        Channel::create([
            'name' => request('name'),
            'slug' => request('name'),
        ]);

        return redirect()->back();
    }
}
