@extends('layouts.app')

@section('content')

<div class="container">

<h2>Add Property</h2>

<form action="{{ route('properties.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label>Title</label>

<input
type="text"
name="title"
class="form-control">

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"></textarea>

</div>

<div class="mb-3">

<label>Price</label>

<input
type="number"
name="price"
class="form-control">

</div>

<div class="mb-3">

<label>Location</label>

<input
type="text"
name="location"
class="form-control">

</div>

<div class="mb-3">

<label>Category</label>

<select
name="category_id"
class="form-select">

@foreach($categories as $category)

<option value="{{ $category->id }}">
{{ $category->name }}
</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Image</label>

<input
type="file"
name="image"
class="form-control">

</div>

<button class="btn btn-primary">

Save Property

</button>

</form>

</div>

@endsection