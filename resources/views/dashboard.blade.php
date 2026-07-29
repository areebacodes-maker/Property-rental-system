@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Dashboard</h2>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Categories</h5>
                    <h2>{{ \App\Models\Category::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Properties</h5>
                    <h2>{{ \App\Models\Property::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card bg-warning">
                <div class="card-body">
                    <h5>Latest Property</h5>
                    <h6>
                        {{ optional(\App\Models\Property::latest()->first())->title ?? 'No Property' }}
                    </h6>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('categories.index') }}" class="btn btn-success">
            Categories
        </a>

        <a href="{{ route('properties.index') }}" class="btn btn-primary">
            Properties
        </a>
    </div>

</div>

@endsection