@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>All Categories</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
        Add Category
    </a>

<form action="{{ route('categories.index') }}" method="GET" class="mb-3">

    <div class="row">

        <div class="col-md-6">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search Category..."
                value="{{ $search }}">

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary">
                Search
            </button>

        </div>

    </div>

</form>

<table class="table table-bordered">

    <tr>
        <th>ID</th>
        <th>Category Name</th>
        <th>Actions</th>
    </tr>

    @forelse($categories as $category)

    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>

            <a href="{{ route('categories.edit',$category->id) }}"
               class="btn btn-warning btn-sm">
                Edit
            </a>

            <form action="{{ route('categories.destroy',$category->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this category?')">
                    Delete
                </button>

            </form>

        </td>
    </tr>

    @empty

    <tr>
        <td colspan="3" class="text-center">
            No Categories Found
        </td>
    </tr>

    @endforelse

</table>

<div class="mt-3">
    {{ $categories->links() }}
</div>    

@endsection