@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Edit Property</h2>

    <form action="{{ route('properties.update', $property->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input
                type="text"
                name="title"
                class="form-control"
                value="{{ old('title', $property->title) }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea
                name="description"
                class="form-control">{{ old('description', $property->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input
                type="number"
                name="price"
                class="form-control"
                value="{{ old('price', $property->price) }}">
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input
                type="text"
                name="location"
                class="form-control"
                value="{{ old('location', $property->location) }}">
        </div>

        <div class="mb-3">
            <label>Category</label>

            <select name="category_id" class="form-select">

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ $property->category_id == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Current Image</label><br>

            @if($property->image)
                <img src="{{ asset('storage/'.$property->image) }}"
                     width="120">
            @endif

        </div>

        <div class="mb-3">

            <label>New Image</label>

            <input
                type="file"
                name="image"
                class="form-control">

        </div>

        <button class="btn btn-success">
            Update Property
        </button>

    </form>

</div>

@endsection