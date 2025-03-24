<!-- resources/views/login.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Connexion</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="/login">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text"
                                       class="form-control
                                       @error('username') is-invalid @enderror"
                                       id="username"
                                       name="username"
                                       value="{{ old('username') }}"
                                       required
                                       placeholder="Enter username">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password"
                                       class="form-control
                                       @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       required
                                       placeholder="Enter password">
                            </div>

                            @if(session('message'))
                                <div class="alert alert-warning">
                                    <h4>{{ session('message') }}</h4>
                                    <p>{{ session('error')  }}</p>
                                </div>
                            @endif

                            <div class="row mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        Connexion
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
