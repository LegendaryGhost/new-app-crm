<!-- resources/views/expenses/edit.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        {{--Details expense--}}
        <div class="card">
            <div class="card-body">
                <h3>Details dépense</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Budget</th>
                        <th>Amount Limit</th>
                        <th>Amount Remain</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            @if($expense['lead'] == null)
                                {{ $expense['ticket']['budget']['name'] }}
                            @else
                                {{ $expense['lead']['budget']['name'] }}
                            @endif
                        </td>
                        <td>
                            @if($expense['lead'] == null)
                                {{ $expense['ticket']['budget']['amountLimit'] }}
                            @else
                                {{ $expense['lead']['budget']['amountLimit'] }}
                            @endif
                        </td>
                        <td>
                            @if($expense['lead'] == null)
                                {{ $expense['ticket']['budget']['amountRemain'] }}
                            @else
                                {{ $expense['lead']['budget']['amountRemain'] }}
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Montant</th>
                        <th>Date de création</th>
                        <th>Lead</th>
                        <th>Ticket</th>
                        <th>Client</th>
                    </tr>
                    </thead>
                    <tbody>
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
                                {{ $expense['ticket']['customer']['name'] }}
                            @else
                                {{ $expense['lead']['customer']['name'] }}
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{--form--}}
        <div class="card">
            <div class="card-body">
                <h3>Mettre à jour une dépense</h3>

                <form method="POST" action="/expenses/edit/{{ $expense['id'] }}">
            @csrf

            <div class="mb-3">
                <label for="amount" class="form-label">Montant</label>
                <input type="number" class="form-control" id="amount" name="amount"
                       value="{{ old('amount', number_format($expense['amount'], 2, '.', '')) }}" step="0.01" min="0">

                @error('amount')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </form>
        </div>

        {{--messages--}}
        <div>
            @if(session('message'))
                <div class="alert alert-warning">
                    {{ session('message') }}
                </div>
            @endif

            @if(session('warningsBudget'))
                <div class="alert alert-warning">
                    <ul>
                        @foreach(session('warningsBudget') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
