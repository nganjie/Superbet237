<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $message = "Vous n'êtes pas autorisé à vous connecter.";
    
        // Vérifier si le champ 'profiladmin' est égal à 1 pour l'utilisateur connecté
        if (($user->profiladmin != 1 && $user->profilregister != 1) || ($user->profiladmin == 0 && $user->profilregister == 0)) {
            // Déconnexion de l'utilisateur
            Auth::logout();
    
            // Redirection vers la page de connexion avec un message d'erreur
            return redirect()->route('login')->with('message', $message);
        }
     
        // Appeler la procédure stockée pour récupérer les rôles de l'utilisateur
        $roles = DB::select('CALL psUserRoles_List(?)', [$user->id]);
    
        // Enregistrer les rôles dans la session de l'utilisateur
        $request->session()->put('user_roles', $roles);
    }

    protected function codeauthenticate(Request $request, $user)
    {
      $email = $request->input('email');
      

    }

}
