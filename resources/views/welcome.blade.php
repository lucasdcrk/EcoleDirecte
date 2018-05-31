@extends('layout')

@section('title', 'Moyenne ('.$user->prenom.' '.$user->nom.')')

@section('content')
    <section class="bg-primary">
        <div class="container">
            <a class="btn btn-outline-default float-right" href="{{ url('login/out') }}">Déconnexion</a>
            <h3 class="text-white font-weight-300 m-b-0">Bonjour, {{ $user->prenom.' '.$user->nom.' ('.$user->classe->libelle.')' }}</h3>
        </div>
    </section>

    <section class="m-y-30">
        <div class="container">
            <div id="accordion" class="accordion" role="tablist">
                @foreach($periodes as $periode)
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h5>
                                <a data-toggle="collapse" href="#collapseOne">
                                    {{ $periode->periode }} (Moyenne : {{ round($periode->moyenne, 2) }})
                                    <div class="float-right">
                                        Trimestre
                                        @if($periode->cloture)
                                            cloturé &nbsp; <i class="fa fa-lock"></i>
                                        @else
                                            ouvert &nbsp; <i class="fa fa-unlock"></i>
                                        @endif
                                    </div>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" role="tabpanel" data-parent="#accordion">
                            <div class="card-body">
                                <table class="ui celled padded table">
                                    <thead>
                                    <tr>
                                        <th class="single line">Matière</th>
                                        <th>Coef</th>
                                        <th>Moyenne</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($periode->matieres as $matiere)
                                        <tr>
                                            <td>{{ $matiere->discipline }}</td>
                                            <td>{{ $matiere->coef }}</td>
                                            <td>{{ round($matiere->moyenne, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $('.ui.accordion')
            .accordion()
        ;
    </script>
@endsection