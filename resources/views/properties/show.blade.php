@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>{{ $property->title }}</h3>
        </div>

        <div class="card-body">

            @if($property->image)
                <img src="{{ asset('storage/'.$property->image) }}"
                     width="350"
                     class="mb-3">
            @endif

            <p><strong>Category:</strong> {{ $property->category->name }}</p>

            <p><strong>Price:</strong> Rs. {{ number_format($property->price) }}</p>

            <p><strong>Location:</strong> {{ $property->location }}</p>

            <p><strong>Description:</strong></p>

            <p>{{ $property->description }}</p>

            <a href="{{ route('properties.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

@endsection