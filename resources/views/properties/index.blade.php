@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>All Properties</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('properties.create') }}" class="btn btn-primary mb-3">
        Add Property
    </a>

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Category</th>
            <th>Price</th>
            <th>Location</th>
        </tr>

        @foreach($properties as $property)

        <tr>

            <td>{{ $property->id }}</td>

            <td>
                @if($property->image)
                    <img src="{{ asset('storage/'.$property->image) }}"
                         width="100">
                @endif
            </td>

            <td>{{ $property->title }}</td>

            <td>{{ $property->category->name }}</td>

            <td>{{ $property->price }}</td>

            <td>{{ $property->location }}</td>

        </tr>

        @endforeach

    </table>

</div>

@endsection