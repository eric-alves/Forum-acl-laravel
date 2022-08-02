@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Editar tópico</h2>
        <hr>
    </div>
    <div class="col-12">
        <form action="{{route('threads.update', $thread->slug)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Título do tópico</label>
                <input name="title" type="text" class="form-control" value="{{$thread->title}}">
            </div>

            <div class="form-group">
                <label>Conteúdo do tópico:</label>
                <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$thread->body}}</textarea>
            </div>

            <button type="submit" class="btn btn-lg btn-success">Atualizar tópico</button>
        </form>
    </div>
</div>
@endsection