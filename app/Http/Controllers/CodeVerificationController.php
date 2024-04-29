<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class CodeVerificationController extends Controller
{
/*     public function sendcodemail(Request $request)
    {
        $email = $request->input('email');
        $code = mt_rand(100000, 999999);
    
        // Vérification de l'existence de l'utilisateur dans la table "users"
        $user = User::where('email', $email)->first();
        if (!$user) {
            $message = "Aucun utilisateur ne possède cet adresse email.";
        session()->flash('message', $message);
            return redirect()->route('code');
           // return redirect()->back()->with('error', 'Utilisateur non trouvé.'); // Ou toute autre logique que vous souhaitez appliquer
        }
    
        // Enregistrement du code et de la date de validité dans la table "users"
        $user->codemail = $code;
        $user->datecodemail = now()->addMinutes(5);
        $user->save();
    
        // Envoi du courrier électronique
        $data['email'] = $email;
        $data['code'] = $code;
        $data['title'] = "CODE DE VERIFICATION";
        $data['body'] = "Votre code de vérification est : " . $data['code'];
        $data['link'] = "https://greco-erp.com/Gestion/public/verif"; // Remplacez par votre lien réel
    
        Mail::send('codeverification', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });
        $message = "Un code de vérification a été envoyé dans votre adresse email!";
        session()->flash('messagesuc', $message);
        //dd($code, $email);
        return redirect()->route('verif');
    } */
    public function sendcodemail(Request $request)
    {
        $client = new Client();
        $email = $request->input('email');
        $code = mt_rand(100000, 999999);
    //dd($email);
        // Vérification de l'existence de l'utilisateur dans la table "users"
        $user = User::where('email', $email)->first();
        if (!$user) {
            $message = "Aucun utilisateur ne possède cet adresse email.";
        session()->flash('message', $message);
            return redirect()->route('code');
           // return redirect()->back()->with('error', 'Utilisateur non trouvé.'); // Ou toute autre logique que vous souhaitez appliquer
        }
  //dd($user->profiladmin);
  if($user->profiladmin == 1){
        // Enregistrement du code et de la date de validité dans la table "users"
        $user->codemail = $code;
        $user->datecodemail = now()->addMinutes(5);
        $user->save();
        $tel = $user->telephone;
        //dd(intval("+237"));
  //dd(intval($tel));
     $userName = $user->name;
     //dd( $userName);
        // Envoi du courrier électronique
        $data['userName'] = $userName;
        $data['email'] = $email;
        $data['code'] = $code;
        $data['title'] = "CODE DE VERIFICATION";
        $data['body'] = "Votre code de vérification est : " . $data['code'];
        $data['link'] = "https://greco-erp.com/Gestion/public/verif"; // Remplacez par votre lien réel
    
        Mail::send('codeverification', ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });

        try {
            $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
                'headers' => [
                    'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'recipient' => intval($tel),
                    'sender_id' => 'ISMP',
                    'type' => 'plain',
                    'message' => 'Votre code de vérification est : ' . $code,
                ],
            ]);
        
            // Traitez la réponse de la requête ici si nécessaire
        
        } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('code');
        }  
         $message = "Un code de vérification a été envoyé dans votre adresse email et votre sms";
        session()->flash('messagesuc', $message);
        //dd($code, $email);
        return redirect()->route('verif');
        }else{
              $message = "Pas accessible pour vous!";
        session()->flash('messagesuc', $message);
        }
        $message = "Pas accessible pour vous!";
        session()->flash('message', $message);
        //dd($code, $email);
        return redirect()->route('code');
    }
 /*    public function verfifavantsendcodesms(Request $request)
    {
        $client = new Client();
        $email = $request->input('email');
        $code = mt_rand(100000, 999999);
    
     // Vérification de l'existence de l'utilisateur dans la table "users"
$user = User::where('email', $email)->first();

if (!$user) {
    $message = "Aucun utilisateur ne possède cette adresse email.";
    session()->flash('message', $message);
    return redirect()->route('sms');
    // return redirect()->back()->with('error', 'Utilisateur non trouvé.'); // Ou toute autre logique que vous souhaitez appliquer
}

// Vérification du champ "telephone"
if (!$user->telephone || empty($user->telephone)) {
    $message = "Le compte de l'utilisateur n'est pas lié à un numéro de téléphone valide.";
    session()->flash('message', $message);
    return redirect()->route('sms');
    // return redirect()->back()->with('error', 'Numéro de téléphone non trouvé.'); // Ou toute autre logique que vous souhaitez appliquer
}
    
        // Enregistrement du code et de la date de validité dans la table "users"
        $user->codemail = $code;
        $user->datecodemail = now();
        $user->save();

        $email = $user->email;
        $telephone = intval($user->telephone);
        $telephoneSans4Derniers = substr($telephone, 0, -4);
         */
        //dd($email, $telephoneSans4Derniers);
/* 
         try {
            $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
                'headers' => [
                    'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'recipient' => intval($user->telephone),
                    'sender_id' => 'ISMP',
                    'type' => 'plain',
                    'message' => 'Votre code de vérification est : ' . $code,
                ],
            ]);
        
            // Traitez la réponse de la requête ici si nécessaire
        
        } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message : " . $e->getMessage();
            session()->flash('message', $message);
            return redirect()->route('sms');
        }  */
 /*         $message = "Un message viens d'etre envoyé a votre numero de téléphone";
                         session()->flash('messagesuc', $message); 
                         return redirect()->route('verifsms')->with([
                            'email' => $email,
                            'telephoneSans4Derniers' => $telephoneSans4Derniers
                        ]);
    } */

    public function sendcodesms(Request $request)
    {
        $client = new Client();
        $telephone = $request->input('telephone');
        $code = mt_rand(100000, 999999);
        $telephone = '+237'.$telephone;
    //dd($telephone);

    if (strlen($telephone) < 12) {
        $message = "numéro de téléphone érroné doit etre de 9 chiffres";
        session()->flash('message', $message);
        return redirect()->route('sms');
        // return redirect()->back()->with('error', 'Utilisateur non trouvé.'); // Ou toute autre logique que vous souhaitez appliquer
    }

     // Vérification de l'existence de l'utilisateur dans la table "users"
$user = User::where('telephone', $telephone)->first();

if (!$user) {
    $message = "numéro de téléphone érroné.";
    session()->flash('message', $message);
    return redirect()->route('sms');
    // return redirect()->back()->with('error', 'Utilisateur non trouvé.'); // Ou toute autre logique que vous souhaitez appliquer
}
     // Enregistrement du code et de la date de validité dans la table "users"
        $user->codemail = $code;
        $user->datecodemail = now();
        $user->save();
   
        //dd($email, $telephoneSans4Derniers);

         try {
            $response = $client->post('https://app.techsoft-sms.com/api/v3/sms/send', [
                'headers' => [
                    'Authorization' => 'Bearer 9|NTTkQIJROPURdSkXnEDSiviZjff8d0SQBFV3EK0w57228ea5',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'recipient' => intval($user->telephone),
                    'sender_id' => 'ISMP',
                    'type' => 'plain',
                    'message' => 'Votre code de vérification est : ' . $code,
                ],
            ]);
        
            // Traitez la réponse de la requête ici si nécessaire
        
        } catch (\Exception $e) {
            // Gérez l'erreur ici
            $message = "Une erreur s'est produite lors de l'envoi du message!";
            session()->flash('message', $message);
            return redirect()->route('sms');
        }  



        
         $message = "Un message viens d'etre envoyé a votre numero de téléphone";
                         session()->flash('messagesuc', $message); 
                         return redirect()->route('verifsms');
    }



    public function confirmcodemail(Request $request){
        $digit1 = $request->input('digit1');
        $digit2 = $request->input('digit2');
        $digit3 = $request->input('digit3');
        $digit4 = $request->input('digit4');
        $digit5 = $request->input('digit5');
        $digit6 = $request->input('digit6');
    
        $code = $digit1 . $digit2 . $digit3 . $digit4 . $digit5 . $digit6;
        $code = intval($code);
    
        // Recherche de l'utilisateur avec le code correspondant
        $user = User::where('codemail', $code)->first();
    
        if ($user) {
            $user->codemail = null;
            $user->datecodemail = null;
            $user->save();

            $roles = DB::select('CALL psUserRoles_List(?)', [$user->id]);
   // dd( $roles);
        // Enregistrer les rôles dans la session de l'utilisateur
        $request->session()->put('user_roles', $roles);
        Auth::loginUsingId($user->id);
            return redirect()->route('home');
            // L'utilisateur avec le code correspondant a été trouvé
            // Votre logique de traitement ici
         //   echo "L'utilisateur avec le code correspondant a été trouvé. ID de l'utilisateur : " . $user->id;
        } else {
            return redirect()->route('verif');
          //  dd('pas trouvé');
            // Aucun utilisateur avec le code correspondant n'a été trouvé
            // Votre logique de gestion d'erreur ici
           // echo "Aucun utilisateur avec le code correspondant n'a été trouvé.";
        }
    }

    public function confirmcodesms(Request $request){
        $digit1 = $request->input('digit1');
        $digit2 = $request->input('digit2');
        $digit3 = $request->input('digit3');
        $digit4 = $request->input('digit4');
        $digit5 = $request->input('digit5');
        $digit6 = $request->input('digit6');
    
        $code = $digit1 . $digit2 . $digit3 . $digit4 . $digit5 . $digit6;
        $code = intval($code);
    
        // Recherche de l'utilisateur avec le code correspondant
        $user = User::where('codemail', $code)->first();
    
        if ($user) {
            $user->codemail = null;
            $user->datecodemail = null;
            $user->save();

            $roles = DB::select('CALL psUserRoles_List(?)', [$user->id]);
   // dd( $roles);
        // Enregistrer les rôles dans la session de l'utilisateur
        $request->session()->put('user_roles', $roles);
        Auth::loginUsingId($user->id);
            return redirect()->route('home');
            // L'utilisateur avec le code correspondant a été trouvé
            // Votre logique de traitement ici
         //   echo "L'utilisateur avec le code correspondant a été trouvé. ID de l'utilisateur : " . $user->id;
        } else {
            return redirect()->route('verif');
          //  dd('pas trouvé');
            // Aucun utilisateur avec le code correspondant n'a été trouvé
            // Votre logique de gestion d'erreur ici
           // echo "Aucun utilisateur avec le code correspondant n'a été trouvé.";
        }
    }
}
