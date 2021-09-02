@extends('layouts.app')
@section('content')
    @if (session('status_success'))
        <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
    @endif
    @if (session('status_error'))
        <div class="alert alert-danger" role="alert">{{ session('status_error') }}</div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pakeiskime informaciją apie klientą</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                            @csrf @method("PUT")
                            <div class="form-group">
                                <label>Vardas: </label>
                                <input type="text" name="name" class="form-control" value="{{ $customer->name }}">
                                @error('name')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Pavardė: </label>
                                <input type="text" name="surname" class="form-control" value="{{ $customer->surname }}">
                                @error('surname')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Telefono numeris: </label>
                                <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
                                @error('phone')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>El.paštas: </label>
                                <input type="text" name="email" class="form-control" value="{{ $customer->email }}">
                                @error('email')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Komentaras: </label>
                                <textarea id="mce" type="text" name="comment" rows=6 cols=100
                                    class="form-control">{{ $customer->comment }}</textarea>
                                @error('registered')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kompanijos pavadinimas: </label>
                                <select name="company_id" class="form-control">
                                    <option value="0" selected enabled>Pasirinkite kompaniją</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" @if ($company->id == $customer->company_id) selected="selected" @endif>
                                            {{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Pakeisti</button>
                            <a class="btn btn-danger" href="{{ route('customers.index') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection