@extends('layout')

@section('title', 'Connexion')

@section('content')
    <section class="bg-image" style="background-image: url('https://images.pexels.com/photos/756908/pexels-photo-756908.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260'); height: 100vh;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-4 mx-auto">
                    <div class="card m-b-0">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-sign-in"></i> Connexion à votre compte EcoleDirecte</h4>
                        </div>
                        <div class="card-block">
                            <form method="POST">
                                @csrf
                                <div class="form-group input-icon-left m-b-10">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name="username" class="form-control form-control-secondary" placeholder="Identifiant">
                                </div>
                                <div class="form-group input-icon-left m-b-15">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name="password" class="form-control form-control-secondary" placeholder="Mot de passe">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block m-t-10">Connexion <i class="fa fa-sign-in"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection