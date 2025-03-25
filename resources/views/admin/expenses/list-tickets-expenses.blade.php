<!-- resources/views/expenses/index.blade.php -->

@extends('template/template')

@section('title')
    Tickets expenses list
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tickets expenses list</h4>

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

                    <div class="table-responsive m-t-40">
                        <table id="config-table" class="table display table-bordered table-striped no-wrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Creation date</th>
                                <th>Ticket</th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Delete</th>
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
                                    <td>
                                        <a href="{{ url('/expenses/' . $expense['id'] . '/delete') }}" class="btn btn-primary">
                                            <i class="mdi mdi-delete"></i>
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
        </div>
    </div>
@endsection
