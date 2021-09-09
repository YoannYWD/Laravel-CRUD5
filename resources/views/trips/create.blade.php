@extends('app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-6 offset-3">
            <form method="POST" action="{{route('home.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                  <label>Lieu</label>
                  <input type="text" name="place" class="form-control" placeholder="Lieu de voyage">
                </div>

                <div class="mb-3">
                  <label>Description</label>
                  <input type="text" name="text" class="form-control" placeholder="Description">
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image">
                </div>

                <input type="hidden" value="{{auth()->id()}}" name="user_id">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

@endsection