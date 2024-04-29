<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
           // Récupérer les rôles de la session
    $userRoles = session('user_roles', []);

    // Passer les rôles à la vue
    return view('module')->with('userRoles', $userRoles);
    }
}
