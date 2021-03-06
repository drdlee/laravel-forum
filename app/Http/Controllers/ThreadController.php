<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Thread;
use App\Channel;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, Threadfilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        return view('threads.index', compact('threads')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $channels = Channel::latest()->get();

        return view('threads.create', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        Thread::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => request('channel_id')
        ]);
        return redirect()->route('threads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
        // return $thread->replies;
        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(3)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread); //this is ThreadPolicy

        if($thread->user_id != auth()->id()){
            abort(403, 'You have no permission yo');
        }

        $thread->delete();

        if(request()->wantsJson()){
            return response([], 204);
        }

        return redirect('/threads');
    }

    public function getThreads($channel, $filters)
    {
        $threads = Thread::latest()->filter($filters); // ->filter($filter) will be ignored if no paramenter passed.
        // dd($threads->get());
        if($channel->exists){
            $threads->where('channel_id', $channel->id);
        }
        return $threads = $threads->get();
    }
}
