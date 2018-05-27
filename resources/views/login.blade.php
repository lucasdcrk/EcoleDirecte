@extends('layout')

@section('title', 'Connexion')

@section('content')
    <section class="hero is-small is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Connexion
                </h1>
                <h2 class="subtitle">
                    Entrez vos identifiants EcoleDirecte
                </h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-2 is-offset-5">
                    <form method="POST">
                        @csrf
                        <div class="field">
                            <label class="label">Nom d'utilisateur</label>
                            <div class="control">
                                <input class="input" type="text" name="username" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Mot de passe</label>
                            <div class="control">
                                <input class="input" type="password" name="password" required>
                            </div>
                        </div>
                        <button type="submit" class="button is-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection