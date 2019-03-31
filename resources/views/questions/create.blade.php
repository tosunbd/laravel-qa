@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-item-center">
                        <h2>Ask Question</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all questions</a>
                        </div>
                    </div>

                    <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @include("questions._form", ['buttonText' => "Ask Question"])
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
