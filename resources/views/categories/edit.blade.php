@extends('layouts.app')

@section('content')

<div class="container mt-4">

<h2>Edit Category</h2>

<form action="{{ route('categories.update',$category->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label class="form-label">Category Name</label>

<input
type="text"
name="name"
class="form-control"
value="{{ old('name',$category->name) }}">

@error('name')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<button class="btn btn-success">
Update Category
</button>

</form>

</div>

@endsection