<!-- resources/views/configurations/edit.blade.php -->

@extends('template/template')

@section('title')
    Import customer
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Import customer</h4>

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

                    <form method="POST" action="/import" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="file" class="form-label">CSV</label>
                            <input type="file" class="form-control-file" id="file" name="file" required>

                            @error('file')
                            <div class="input-group">
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
