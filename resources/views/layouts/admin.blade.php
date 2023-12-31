<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/dox8qou.css">
    <title>Vino - @yield('title')</title>
    <style>

        .admin-nav-list {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(4, minmax(20%, auto));
            position: fixed;
            bottom: 0;
            padding-bottom: 0.5em;
            background-color: white;
        }

        .admin-table-container {
            width: 100%; 
            padding: 1rem 1rem;
        }

        .admin-show-container {
            width: 100%; 
        }

        /* .admin-table-container-show {
            display: flex;
            flex-wrap: wrap; 
            border: 1px solid #000000; 
            border-radius: 10px; 
            margin: .5rem;
        }

        .table-row{
            width: 100%;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #000000;
        }

        .table-header {
            width: 8rem;
            text-align: left; 
            margin: 1rem;
        }

        .table-data{
            max-width: ;
        } */
        .admin-table-container-show {
            display: flex;
            flex-direction: column;
            border: 1px solid #000000;
            border-radius: 10px;
            margin: .5rem;
        }

        .table-row {
            display: flex;
            align-items: center;
        }

        .table-row:not(:last-child) {
            border-bottom: 1px solid #000000;
        }

        .table-header {
            width: 33.33%; /* 1/3 de la largeur */
            text-align: left;
            margin: 1rem;
        }

        .table-data {
            width: 66.66%; /* 2/3 de la largeur */
            max-width: 100%;
            word-break: break-all;
            margin: 1rem;
        }

    </style>
</head>
<body>
    @if(session('success'))
        <div role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    @if(!$errors->isEmpty())
        <div role="alert">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
    <nav class="main-nav">
        <ul class="admin-nav-list">
            <li class="main-nav-item">        
                <a href="#">
                    <figure class="container-icons-navbar active">
                        <img src="{{ asset('assets/icons/admin_users_icon.svg') }}" alt="Accueil">
                        <figcaption>utilisateurs</figcaption>
                    </figure>
                </a>
            </li>
            <li class="main-nav-item">        
                <a href="#">
                    <figure class="container-icons-navbar">
                        <img src="{{ asset('assets/icons/add_icon.svg') }}" alt="Recherche">
                        <figcaption class="icons-label">bouteilles</figcaption>
                    </figure>
                </a>
            </li>
            <li class="main-nav-item">
                <a href="#">
                    <figure class="container-icons-navbar">
                        <img src="{{ asset('assets/icons/admin_stats_icon.svg') }}" alt="Liste d'achats">
                        <figcaption>statistiques</figcaption>
                    </figure>
                </a>
            </li>
            <li class="main-nav-item">         
                <a href="#">
                    <figure class="container-icons-navbar">
                        <img src="{{ asset('assets/icons/profile_icon.svg') }}" alt="Profil">
                        <figcaption>profil</figcaption>
                    </figure>
                </a>
            </li>
        </ul>
    </nav>
</body>
</html>