@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Editar tópico</h2>
        <hr>
    </div>
    <div class="col-12">
        <form action="{{route('threads.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label>Título do tópico</label>
                <input name="title" type="text" class="form-control" value="">
            </div>

            <div class="form-group">
                <label>Conteúdo do tópico:</label>
                <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-lg btn-success">Criar tópico</button>
        </form>
    </div>
</div>
@endsection