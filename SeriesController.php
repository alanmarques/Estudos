<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function index(Request $request)
    {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request
            ->session()
            ->get('mensagem');

        $request->session()->remove('mensagem');



        return view('series.index', compact('series', 'mensagem'));
        //$html = "<ul>";
        //foreach ($series as $series){
        //  $html .= "<li> $series</li>";
        //}
        //$html .= "</ul>";

        //return $html;
    }
    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $serie = Serie::create($request->all());
        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} criada com sucesso: {$serie->nome}"
            );


        return redirect('/series');
    }
}
