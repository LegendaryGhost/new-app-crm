<!-- resources/views/expenses/index.blade.php -->

@extends('template/template')

@section('title')
    Budgets list
@endsection

@section('content')
    <div class="container">
        <h1>Budgets list</h1>

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

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Creation date</th>
                        <th>Customer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($budgets as $budget)
                        <tr>
                            <td>{{ $budget['id'] }}</td>
                            <td>{{ $budget['name'] }}</td>
                            <td>{{ number_format($budget['amount'], 2, ',', ' ') }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($budget['createdAt'])) }}</td>
                            <td>{{ $budget['customer']['name'] ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Aucun budget à afficher.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
