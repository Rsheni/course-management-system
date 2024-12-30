@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Are you sure you want to delete the course: "{{ $course->name }}"?</h1>

        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Yes, Delete Course</button>
        </form>

        <a href="{{ route('courses.index') }}">Cancel</a>
    </div>
@endsection
