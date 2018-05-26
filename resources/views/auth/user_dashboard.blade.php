@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <p>{{ Auth::user()->name }}</p>
                        <p>{{ Auth::user()->email }}</p>
                        <p>{{ Auth::user()->rut }}</p>
                        <p>User of division: {{ Auth::user()->division->division_name }}</p>
                        <p> <a href="{{ route('user.portability') }}"> Port </a> </p>

                    @foreach(Auth::user()->number as $number)
                            <article>
                                {{$number->number}}
                                @if ($number->deactivated)
                                    Deactivated
                                @else Activated
                                @endif

                            </article>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection