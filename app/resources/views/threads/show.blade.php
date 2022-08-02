@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>{{$thread->title}}</h2>
            <hr>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Criado por {{$thread->user->name}} a {{$thread->created_at->diffForHumans()}}
                </div>
                <div class="card-body">
                    {{$thread->body}}
                </div>
                <div class="card-footer  d-flex">
                    <a href="{{route('threads.edit', $thread->slug)}}" class="btn btn-sm btn-primary">Editar</a>

                    <form action="{{route('threads.destroy', $thread->slug)}}" method="POST">
                        @csrf 
                        @method('DELETE')    
                        <button class="btn btn-sm btn-danger">Deletar</button>
                    </form>

                </div>
            </div>
            <hr>
        </div>
        <div class="col-12">
            <h3>Resposta</h3>
            <hr>
            @foreach($thread->replies as $reply)
                <div class="card" style="margin-bottom: 15px;">
                    <div class="card-body">
                        {{$reply->reply}}
                    </div>
                    <div class="card-footer">
                        Respondido por {{$reply->user->name}} à {{$reply->created_at->diffForHumans()}}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-12">
            <hr>
            <form action="{{route('replies.store')}}" method="post">
                @csrf
                <input type="hidden" name="thread_id" value="{{$thread->id}}">
                <div class="form-group">
                    <label>Responder</label>
                    <textarea name="reply" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <button type="submit">Responder</button>
            </form>
        </div>
    </div>
@endsection