@extends('layouts.app')
@section('content')
    @if (session('status_success'))
        <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
    @endif
    @if (session('status_error'))
        <div class="alert alert-danger" role="alert">{{ session('status_error') }}</div>
    @endif
    <div class="card-body">
        <form class="form-inline" action="{{ route('customers.index') }}" method="GET">
            <select name="company_id" class="form-control">
                <option selected disabled>Pasirinkite kompaniją filtravimui:</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @if ($company->id == app('request')->input('company_id')) selected="selected" @endif>{{ $company->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filtruoti</button>
            <a class="btn btn-success" href={{ route('customers.index') }}>Rodyti visus</a>
        </form>
    </div>

    <div class="card-body">
        <table class="table">
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Telefonas</th>
                <th>El. paštas</th>
                <th>Komentaras</th>
                <th>Kompanijos pavadinimas</th>
                <th>Veiksmai</th>
            </tr>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->surname }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{!! $customer->comment !!}</td>
                    <td>
                        @if ($customer->company)
                            {{ $customer->company->name }}
                        @endif
                    </td>
                    <td>
                        <form action={{ route('customers.destroy', $customer->id) }} method="POST">
                            <a class="btn btn-success" href={{ route('customers.edit', $customer->id) }}>Redaguoti</a>
                            @csrf @method('delete')
                            <input type="submit" class="btn btn-danger" value="Trinti" />
                        </form>
                    </td>

                </tr>
            @endforeach
        </table>
        <div>
            <a href="{{ route('customers.create') }}" class="btn btn-success">Pridėti</a>
        </div>
    </div>
@endsection
