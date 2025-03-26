<!-- resources/views/expenses/edit.blade.php -->

@extends('template/template')

@section('title')
    Update budget
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update budget</h4>

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

                    <form action="{{ url('/budgets/' . $budget['id'] . '/edit') }}" id="email-form" method="post">
                        @csrf

                        <p class="m-t-20">Description: {{ $budget['name']  }}</p>

                        <label class="m-t-20" for="amount">Amount:</label>
                        <div class="input-group">
                            <input type="number" id="amount" name="amount" class="form-control"
                                   value="{{ old('amount', number_format($budget['amount'], 2, '.', '')) }}" step="0.01" min="0">
                        </div>
                        @error('amount')
                        <div class="input-group">
                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                        </div>
                        @enderror

                        <button type="submit" class="btn btn-primary m-t-20">Update budget</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
