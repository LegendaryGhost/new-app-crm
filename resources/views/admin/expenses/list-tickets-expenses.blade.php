<!-- resources/views/expenses/index.blade.php -->

@extends('template/template')

@section('content')
    <div class="container">
        <h1>Tickets expenses list</h1>

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
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Creation date</th>
                        <th>Ticket</th>
                        <th>Status</th>
                        <th>Customer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expense['id'] }}</td>
                            <td>{{ $expense['description'] }}</td>
                            <td>{{ number_format($expense['amount'], 2, ',', ' ') }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($expense['creationDate'])) }}</td>
                            <td>{{ $expense['ticket']['subject'] }}</td>
                            <td>{{ $expense['ticket']['status'] }}</td>
                            <td>{{ $expense['ticket']['customer']['name'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Aucune dépense à afficher.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
