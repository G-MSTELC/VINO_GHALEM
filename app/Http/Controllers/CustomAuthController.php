<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'nom' => 'required|min:2|max:20|alpha',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ],
        [
            'nom.required' => 'Veuillez saisir votre nom',
            'nom.min' => 'Votre nom doit contenir au moins 2 caractères',
            'nom.max' => 'Votre nom ne doit pas dépasser 20 caractères',
            'nom.alpha' => 'Votre nom ne doit contenir que des lettres',
            'email.required' => 'Veuillez saisir votre adresse email',
            'password.required' => 'Veuillez saisir votre mot de passe',
            'password.min' => 'Votre mot de passe doit contenir au moins 6 caractères',
            'password.confirmed' => 'Les mots de passe ne correspondent pas'
        ]
    );

        $user = new User;
        $user->nom = $request->input('nom');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect(route('welcome'))->withSuccess('Utilisateur enregistré');
    }

    public function authentication(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ], [
            
            'email.required' => 'Veuillez saisir votre adresse email',
            'email.email' => 'Veuillez entrer une adresse email valide',
            'password.required' => 'Veuillez saisir votre mot de passe',
            ]
        );
    
        $credentials = $request->only('email', 'password');
        // dd($credentials);
    // dd(Auth::validate($credentials)
    // );
        if (!Auth::validate($credentials)) {
            return redirect('login')
                ->withErrors([
                    'email' => 'ladresse email ou le mot de passe est incorrect'
                ])
                ->withInput();
        }
    
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
    
        Auth::login($user, $request->get('remember'));
    
        return redirect()->route('welcome'); 
        // return redirect()->route('welcome')->with('success', 'Vous êtes connectés')->with('name', $user->nom);
    }
    

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect(route('login'))->withSuccess('Vous êtes déconnectés');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('utilisateur.index', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

}