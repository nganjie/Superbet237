<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Organisation;

class ParamController extends Controller
{
    public function setParam(Request $request)
    {
        $param = $request->input('param');
        session()->put('paramValue', $param);
        return redirect()->route('AccueilAdmin');
    }
    public function getParamValue()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        
        return view('AccueilAdmin', ['paramValue' => $paramValue]);
    }
    public function getParameva()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        
        return view('evaluation', ['paramValue' => $paramValue]);
    }

    public function getParamperio()
    {
        $paramValue = Session::get('paramValue');
    
        // Faites quelque chose avec la valeur récupérée
    
        $organisations = Organisation::all();
    
        return view('periodeAca', ['paramValue' => $paramValue, 'organisations' => $organisations]);
    }

  
    public function getParamparc()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        
        return view('parcoursAca', ['paramValue' => $paramValue]);
    }
    
    public function getParampromo()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        $organisations = Organisation::all();
        return view('promotionAca', ['paramValue' => $paramValue, 'organisations' => $organisations]);
    }

    public function getParamregrou()
    {
        $paramValue = Session::get('paramValue');
        // Faites quelque chose avec la valeur récupérée
        
        return view('regroupement', ['paramValue' => $paramValue]);
    }

    
}
?>