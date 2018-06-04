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
            'base_uri' => 'https://vmws03.ecoledirecte.com/v3/',
            'timeout'  => 5.0,
        ]);

        $response = $client->request('POST', 'eleves/'.$request->session()->get('user')->id.'/notes.awp?verbe=get&', [
            'body' => 'data={"token":"'.$request->session()->get('token').'"}'
        ]);

        $response = json_decode($response->getBody());

        if(empty($response->data->notes))
        {
            $request->session()->flush();
            $request->session()->regenerate();

            return redirect('login');
        }

        $notes = $response->data->notes;
        $periodes = $response->data->periodes;

        foreach($periodes as $pkey => $periode)
        {
            if($periode->idPeriode == 'A001' or $periode->idPeriode == 'A002' or $periode->idPeriode == 'A003')
            {
                $periode->matieres = [];
                $periode->totalMoyennes = 0;
                $periode->totalCoefs = 0;

                foreach($periode->ensembleMatieres->disciplines as $mkey => $matiere)
                {
                    $matiere->notes = [];
                    $matiere->totalNotes = 0;
                    $matiere->totalCoefs = 0;

                    foreach($notes as $note)
                    {
                        if($matiere->codeMatiere == $note->codeMatiere AND $periode->idPeriode == $note->codePeriode)
                        {
                            $note->valeur = str_replace(',', '.', $note->valeur);

                            if(is_numeric($note->valeur))
                            {
                                $matiere->notes[] = (20 / intval($note->noteSur)) * $note->valeur;
                                $matiere->totalNotes = $matiere->totalNotes + $note->valeur * $note->coef;
                                $matiere->totalCoefs = $matiere->totalCoefs + $note->coef;
                            }
                        }
                    }

                    if(count($matiere->notes) > 0)
                    {
                        $matiere->moyenne = $matiere->totalNotes / $matiere->totalCoefs;
                        $periode->matieres[] = $matiere;
                        $periode->totalMoyennes = $periode->totalMoyennes + $matiere->moyenne * $matiere->coef;
                        $periode->totalCoefs = $periode->totalCoefs + $matiere->coef;
                    }
                }

                $periode->moyenne = $periode->totalMoyennes / $periode->totalCoefs;
            }
            else
            {
                unset($periodes[$pkey]);
            }
        }

        return view('welcome')
            ->with('user', $request->session()->get('user'))
            ->with('periodes', $periodes);
    }
}
