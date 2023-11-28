@extends('layouts.app')

@section('content')
@livewireStyles
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Livewire</a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-3">
            @livewire('jadwal')
        </div>
    </div>
    
    @livewireScripts
    </body>
@endsection
