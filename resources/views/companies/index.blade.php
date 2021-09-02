@extends('layouts.app')
@section('content')
    @if (session('status_success'))
        <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
    @endif
    @if (session('status_error'))
        <div class="alert alert-danger" role="alert">{{ session('status_error') }}</div>
    @endif
    <div class="card-body">
        <form class="form-inline" action="{{ route('companies.index') }}" method="GET">
            <select name="company_id" class="form-control">
                <option selected disabled>Pasirinkite kompaniją filtravimui:</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @if ($company->id == app('request')->input('company_id')) selected="selected" @endif>{{ $company->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filtruoti</button>
            <a class="btn btn-success" href={{ route('companies.index') }}>Rodyti visus</a>
        </form>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Pavadinimas</th>
                <th>Adresas</th>
                <th>Veiksmai</th>
            </tr>
            @foreach ($data as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->address }}</td>
                    <td>
                        <form action={{ route('companies.destroy', $company->id) }} method="POST">
                            <a class="btn btn-success" href={{ route('companies.edit', $company->id) }}>Redaguoti</a>
                            @csrf @method('delete')
                            <input type="submit" class="btn btn-danger" value="Trinti" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div>
            <a href="{{ route('companies.create') }}" class="btn btn-success">Pridėti</a>
        </div>
    </div>
@endsection
