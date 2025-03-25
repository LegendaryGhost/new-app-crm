<!-- resources/views/expenses/index.blade.php -->

@extends('template/template')

@section('title')
    Budgets list
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Budgets list</h4>

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
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Creation date</th>
                                <th>Customer</th>
                                <th>Delete</th>
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
                                    <td>
                                        <a href="{{ url('/budgets/' . $budget['id'] . '/delete') }}" class="btn btn-primary">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
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
        </div>
    </div>
@endsection
