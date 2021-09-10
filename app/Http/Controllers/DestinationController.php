<?php

namespace App\Http\Controllers;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinationController extends Controller
{
    //AFFICHAGE PAGE INDEX
    public function index() {
        $destinations = DB::table('destinations')
        ->join('users', 'destinations.user_id', '=', 'users.id')
        ->select('destinations.id', 'destinations.place', 'destinations.text', 'destinations.image', 'destinations.user_id', 'users.name as user')
        ->get();
        return view('trips/index', compact('destinations'));
    }
    //AFFICHER PAGE CREATE
    public function create() {
        return view('trips/create');
    }

    //ENREGISTREMENT DES DONNEES
    public function store(Request $request) {
        $imageName = "";
        if ($request->image) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        $newDestination = new Destination;
        $newDestination->place = $request->place;
        $newDestination->text = $request->text;
        $newDestination->image = '/images/' . $imageName;
        $newDestination->user_id = $request->user_id;
        $newDestination->save();

        return redirect()->route('home.index')
                         ->with('success', 'Destination enregistrée !')
                         ->with('image', $imageName);
    }

}
