<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\ThreadRequest;

class ThreadController extends Controller
{
    public function __construct(Thread $thread){
        $this->thread = $thread;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Channel $channel)
    {
        $channelParam = $request->channel;

        if ($channelParam !== null) {
            $threads = $channel->whereSlug($channelParam)->first()->threads()->paginate(10);
        } else {
            $threads = $this->thread->orderBy("created_at", "DESC")->paginate(20);
        }

        return view("threads.index", compact("threads"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Channel $channel)
    {
        return view("threads.create", [
            "channels" => $channel->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ThreadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        try {
            $user = User::find(1);
            $thread = $request->all();
            $thread['slug'] = Str::slug($thread['title']);
            $thread['user_id'] = $user->id;
            $thread = $this->thread->create($thread);
            flash("Tópico criado com sucesso!")->success();
            return redirect()->route("threads.show", $thread->slug);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') 
                ? $e->getMessage()
                : "Erro ao precessar a requisição!";
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();

        if (!$thread) return redirect()->route('threads.index');

        return view("threads.show", compact("thread"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit($thread)
    {
        $thread = $this->thread->whereSlug($thread)->first();
        return view("threads.edit", compact("thread"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ThreadRequest  $request  $request
     * @param  string $thread
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, $thread)
    {
        try {
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->update($request->all());
            flash("Tópico editado com sucesso!")->success();
            return redirect()->route("threads.show", $thread->slug);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') 
                ? $e->getMessage()
                : "Erro ao precessar a requisição!";
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($thread)
    {
        try {
            $thread = $this->thread->whereSlug($thread)->first();
            $thread->delete();
            flash("Tópico removido com sucesso!")->success();
            return redirect()->route("threads.index");
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') 
                ? $e->getMessage()
                : "Erro ao precessar a requisição!";
            flash($message)->warning();
            return redirect()->back();
        }
    }
}
