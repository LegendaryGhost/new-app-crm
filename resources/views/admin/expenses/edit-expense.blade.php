<!-- resources/views/expenses/edit.blade.php -->

@extends('template/template')

@section('title')
    Leads expenses list
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update expense</h4>

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

                    <form action="{{ url('/expenses/' . $expense['id'] . '/edit') }}" id="email-form" method="post">
                        @csrf

                        <p class="m-t-20">Description: {{ $expense['description']  }}</p>

                        <label class="m-t-20" for="amount">Amount:</label>
                        <div class="input-group">
                            <input type="number" id="amount" name="amount" class="form-control"
                                   value="{{ old('amount', number_format($expense['amount'], 2, '.', '')) }}" step="0.01" min="0">
                        </div>
                        @error('amount')
                        <div class="input-group">
                                    <span class="text-danger font-weight-bold">{{ $message }}</span>
                        </div>
                        @enderror

                        <button type="submit" class="btn btn-primary m-t-20">Update expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
