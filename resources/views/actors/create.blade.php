@extends('layouts.app')

@section('title', 'Submit Actor')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Submit Actor</h1>
        <a href="{{ route('actors.index') }}" class="btn btn-secondary">View All</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('actors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Actor Description</label>
            <textarea
                name="description"
                id="description"
                class="form-control"
                rows="5"
                placeholder="Example: My name is John Doe. I live at 123 Main St, New York. I am 185cm tall and have an athletic build."
                required>{{ old('description') }}</textarea>
            <div class="form-text text-muted">
                Please enter your first name and last name, and also provide your address.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit Profile</button>
    </form>
@endsection
