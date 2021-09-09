<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index() {
        return view('auth.login');
    }

    public function userLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home')
                             ->with('success', 'Utilisateur connecté.');
        }

        return redirect('/home/login')->with('success', 'Votre email ou mot de passe est incorrect.');
    }

    public function registration() {
        return view('auth.registration');
    }

    public function userRegistration(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect('/home/login')->with('success', 'Vous êtes enregistré.');
    }

    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard() {
        if(Auth::check()) {
            return view('dashboard/index');
        }
        return redirect('auth/login')->with('success', "Vous n'êtes pas connecté.");
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return redirect('home');
    }
}
