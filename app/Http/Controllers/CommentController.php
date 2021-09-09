<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    //AFFICHER PAGE CREATE
    public function create(Request $request) {
        $id = $request->id;
        $destination = DB::table('destinations')
                        ->join('users', 'destinations.user_id', '=', 'users.id')
                        ->select('destinations.id', 'destinations.place', 'destinations.text', 'destinations.image', 'users.name as user')
                        ->where('destinations.id', '=', $id)
                        ->get();
        $comments = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->select('comments.id', 'comments.text', 'comments.created_at', 'users.name as user')
                        ->get();
        return view('comments/create', compact('destination', 'comments'));
    }

    //ENREGISTRER LE COMMENTAIRE
    public function store(Request $request) {
        $newComment = new Comment;
        $newComment->text = $request->text;
        $newComment->user_id = $request->user_id;
        $newComment->destination_id = $request->destination_id;
        $newComment->save();
        return redirect()->route('home.index')
                        ->with('success', 'Commentaire enregistré !');
    }

}
