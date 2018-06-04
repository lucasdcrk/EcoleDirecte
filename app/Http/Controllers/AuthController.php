<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function do_login(Request $request)
    {
        $client = new Client([
            'base_uri' => 'https://vmws03.ecoledirecte.com/v3/',
            'timeout'  => 5.0,
        ]);

        $response = $client->request('POST', 'login.awp', [
            'body' => 'data={"identifiant":"'.$request->username.'","motdepasse":"'.$request->password.'"}'
        ]);

        $response = json_decode($response->getBody());

        if($response->code == 505)
        {
            return 'Identifiants incorrects';
        }

        $eleves = $response->data->accounts['0']->profile->eleves;
        $compte = null;

        if(count($eleves) < 2 or !isset($request->name))
        {
            $compte = $eleves[0];
        }
        else
        {
            foreach($eleves as $e)
            {
                if($e->prenom == $request->name)
                {
                    $compte = $e;
                }
            }
        }

        $request->session()->put('token', $response->token);
        $request->session()->put('user', $compte);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }
}
