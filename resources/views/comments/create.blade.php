@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 mt-5 mb-4">
            <div class="card" style="width: 18rem;">
                <img src="{{$destination[0]->image}}" class="card-img-top" alt="Image de {{$destination[0]->place}}" style="height: 18rem;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{$destination[0]->place}}</h5>
                    <p>{{$destination[0]->text}}</p>
                    <p>Posté par {{$destination[0]->user}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($comments as $comment)
            <div class="col-6 offset-3 mb-3">
                <p>{{$comment->text}}</p>
                <p><i>Posté par {{$comment->user}} le {{$comment->created_at}}</i></p>
            </div>
        @endforeach
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form method="POST" action="{{route('comments.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                  <label>Votre commentaire</label>
                  <input type="text" name="text" class="form-control" placeholder="Lachez votre plus beau com'">
                </div>

                <input type="hidden" value="{{auth()->id()}}" name="user_id">
                <input type="hidden" value="{{$destination[0]->id}}" name="destination_id">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

@endsection