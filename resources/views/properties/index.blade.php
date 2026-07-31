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


        <form action="{{ route('properties.index') }}" method="GET" class="mb-3">

    <div class="row">

        <div class="col-md-4">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by title or location..."
                value="{{ $search }}">

        </div>

        <div class="col-md-3">

            <select name="category" class="form-select">

                <option value="">All Categories</option>

                @foreach($categories as $cat)

                    <option
                        value="{{ $cat->id }}"
                        {{ $category == $cat->id ? 'selected' : '' }}>

                        {{ $cat->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary">
                Search
            </button>

        </div>

        <div class="col-md-2">

            <a href="{{ route('properties.index') }}" class="btn btn-secondary">
                Reset
            </a>

        </div>

    </div>

</form>

        

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Category</th>
            <th>Price</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>

        @forelse($properties as $property)

        <tr>

            <td>{{ $property->id }}</td>

            <td>
                @if($property->image)
                    <img src="{{ asset('storage/'.$property->image) }}"
                         width="100">
                @endif
            </td>

            <td><a href="{{ route('properties.show',$property->id) }}">
    {{ $property->title }}
</a></td>

            <td>{{ $property->category->name }}</td>

            <td>Rs. {{ number_format($property->price) }}</td>

            <td>{{ $property->location }}</td>

            <td>

<a href="{{ route('properties.show',$property->id) }}"
class="btn btn-info btn-sm">

View

</a>

    <a href="{{ route('properties.edit', $property->id) }}"
       class="btn btn-warning btn-sm">
        Edit
    </a>

    <form action="{{ route('properties.destroy', $property->id) }}"
          method="POST"
          style="display:inline;">

        @csrf
        @method('DELETE')

        <button
            class="btn btn-danger btn-sm"
            onclick="return confirm('Delete this property?')">

            Delete

        </button>

    </form>

</td>
        </tr>

@empty

<tr>
    <td colspan="7" class="text-center">
        No Properties Found
    </td>
</tr>

        @endforelse

    </table>

<div class="mt-3">
    {{ $properties->links() }}
</div>



       

</div>

@endsection