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
                    <div class="card-header">Pakeiskite informaciją apie kompaniją</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('companies.update', $company->id) }}">
                            @csrf @method("PUT")
                            <div class="form-group">
                                <label>Pavadinimas: </label>
                                <input type="text" name="name" class="form-control" value="{{ $company->name }}">
                                @error('name')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Adresas: </label>
                                <input type="text" name="address" class="form-control" value="{{ $company->address }}">
                                @error('address')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Pakeisti</button>
                            <a class="btn btn-danger" href="{{ route('companies.index') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection