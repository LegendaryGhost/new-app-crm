<!-- resources/views/configurations/edit.blade.php -->

@extends('template/template')

@section('title')
    Update expense threshold
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update the configuration's expense threshold percentage</h4>

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

                    <form method="POST" action="/configurations/expense-threshold/edit">
                        @csrf

                        <div class="mb-3">
                            <label for="threshold" class="form-label">Threshold percentage</label>
                            <input type="number" class="form-control" id="threshold" name="threshold"
                                   value="{{ old('rate', number_format($threshold, 2, '.', '')) }}" step="0.01"
                                   >

                            @error('threshold')
                            <div class="input-group">
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update threshold</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
