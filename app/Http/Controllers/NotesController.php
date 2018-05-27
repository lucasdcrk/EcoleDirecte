<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client([
            'base_uri' => 'https://vmws14.ecoledirecte.com/v3/',
            'timeout'  => 50.0,
        ]);

        $response = $client->request('POST', 'eleves/'.$request->session()->get('user')->id.'/notes.awp?verbe=get&', [
            'body' => 'data={"token":"'.$request->session()->get('token').'"}'
        ]);

        $response = json_decode($response->getBody());

        $notes = $response->data->notes;
        $periodes = $response->data->periodes;
        $matieres = $periodes['0']->ensembleMatieres->disciplines;

        $moyenne = 0;
        $coefs = 0;

        foreach($matieres as $m)
        {
            foreach($notes as $n)
            {
                if($n->codeMatiere == $m->codeMatiere)
                {
                    $m->notes[] = $n;
                }
            }

            $m->moyenne = 0;
            $m->coefs = 0;

            foreach($m->notes as $mn)
            {
                if($mn->noteSur == 10)
                {
                    $mn->valeur = 2 * intval($mn->valeur);
                }
                $m->moyenne = $m->moyenne + (intval($mn->valeur)) * intval($mn->coef);
                $m->coefs = $m->coefs + intval($mn->coef);
            }

            $m->moyenne = $m->moyenne / $m->coefs;

            $moyenne = $moyenne + $m->moyenne * $m->coef;
            $coefs = $coefs + $m->coef;
        }

        $moyenne = $moyenne / $coefs;

        return view('welcome')
            ->with('user', $request->session()->get('user'))
            ->with('matieres', $matieres)
            ->with('moyenne', $moyenne);
    }
}
