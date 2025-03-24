<!-- resources/views/configs/edit.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        {{--form--}}
        <div class="card">
            <div class="card-body">
                <h3>Mettre à jour la configuration de taux d'alerte</h3>

                <form method="POST" action="/configs/edit">
                    @csrf

                    <div class="mb-3">
                        <label for="rate" class="form-label">Taux</label>
                        <input type="number" class="form-control" id="rate" name="rate"
                               value="{{ old('rate', number_format($config['rate'], 2, '.', '')) }}" step="0.01"
                               min="0">

                        @error('rate')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>

            {{--messages--}}
            <div>
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-warning">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
@endsection
