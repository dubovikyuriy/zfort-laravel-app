@extends('layouts.app')

@section('title', 'Actor Submissions')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Actor Submissions</h1>
        <a href="{{ route('actors.create') }}" class="btn btn-primary">Add New</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
            <tr>
                <th>First Name</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Height</th>
            </tr>
            </thead>
            <tbody>
            @forelse($actors as $actor)
                <tr>
                    <td>{{ $actor->first_name }}</td>
                    <td>{{ $actor->address }}</td>
                    <td>{{ $actor->gender ?? '-' }}</td>
                    <td>{{ $actor->height ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No actors found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
