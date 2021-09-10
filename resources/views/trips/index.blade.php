@extends('app')

@section('content')

<div class="container">
    <div class="row">

            <h1 class="text-center">Liste des destinations de nos utilisateurs</h1>

            @foreach($destinations as $destination)
            <div class="col-3 mt-5 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{$destination->image}}" class="card-img-top" alt="Image de {{$destination->place}}" style="height: 18rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$destination->place}}</h5>
                        <p>{{$destination->text}}</p>
                        <p>Posté par {{$destination->user}}</p>
                        <form action="{{route('comments.create', $destination->id)}}" method="GET">
                            @csrf
                            <input type="hidden" value="{{$destination->id}}" name="id">
                            <button type="submit" class="btn btn-primary mb-2">Commenter</button>
                        </form>
                        @if($destination->user_id == auth()->id())
                        <form action="" method="POST">
                                <a href="" class="btn btn-primary">Editer</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</a>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach


        
    </div>
</div>

@endsection