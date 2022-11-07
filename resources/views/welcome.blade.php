@extends('layouts.main')

@section('title')
    Welcome
@endsection

@section('content')
    <h2>
        <a href="" data-target="#sidebar" data-toggle="collapse" class="hidden-md-up"><i class="fa fa-bars"></i></a>
        Content
    </h2>
    <h6 class="hidden-sm-down">Shrink page width to see sidebar collapse</h6>
    <p>
        Kindly do the following
    <ul>
        <li>
            Create .env
        </li>
        <li>
            Install composer
        </li>
        <li>
            configure database
        </li>
        <li>
            Run "php artisan migrate --seed"
        </li>
        <li>
            Run "php artisan serve to test the application"
        </li>

    </ul>
    </p>
@endsection
