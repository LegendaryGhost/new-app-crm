<!-- resources/views/expenses/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Dépenses</h1>

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
                        <th>ID</th>
                        <th>Montant</th>
                        <th>Date de création</th>
                        <th>Lead</th>
                        <th>Ticket</th>
                        <th>Budget</th>
                        <th>Client</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>
                                <a href="/expenses/edit/{{ $expense['id'] }}" class="btn btn-primary">
                                    {{ $expense['id'] }}
                                </a>
                            </td>
                            <td>{{ number_format($expense['amount'], 2, ',', ' ') }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($expense['creationDate'])) }}</td>
                            <td>{{ $expense['lead']['leadId'] ?? '-' }}</td>
                            <td>{{ $expense['ticket']['ticketId'] ?? '-' }}</td>
                            <td>
                                @if($expense['lead'] == null)
                                    {{ $expense['ticket']['budget']['name'] }}
                                @else
                                    {{ $expense['lead']['budget']['name'] }}
                                @endif
                            </td>
                            <td>
                                @if($expense['lead'] == null)
                                    {{ $expense['ticket']['customer']['name'] }}
                                @else
                                    {{ $expense['lead']['customer']['name'] }}
                                @endif
                            </td>
                            <td>
                                <a href="/expenses/delete/{{ $expense['id'] }}" class="btn btn-warning">
                                    Delete
                                </a>
                            </td>
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
