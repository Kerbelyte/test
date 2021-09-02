@extends('layouts.app')

@section('content')
    <div style="padding-top: 30px" class="container">
        <div>
            <div>
                <h1>Klientų kontaktinės informacijos sistema</h1>
            </div>
            <div>
                Šia sistema gali naudotis tik prisijungę vadybininkai.
                <div>Prisijungę jūs galėsite:
                    <ul>
                        <li>Pridėti, redaguoti ir ištrinti klientus</li>
                        <li>Pridėti, redaguoti ir ištrinti kompanijas</li>
                        <li>Išsifiltruoti klientus, pagal jų pasirinktą kompaniją</li>
                    </ul>
                </div>
            </div>
            <div>
                @if (!auth()->check())
                    <a class="btn btn-lg btn-outline-info px-5" href="{{ route('login') }}">Prisijungti</a>
                @endif
            </div>
        </div>
    </div>
@endsection