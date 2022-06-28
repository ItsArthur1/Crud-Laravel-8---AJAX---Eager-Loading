@extends('layouts.app')

@section('template_title')
    {{ $empleo->name ?? 'Show Empleo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Empleo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('empleos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Empleo:</strong>
                            {{ $empleo->empleo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
