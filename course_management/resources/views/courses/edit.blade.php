
@extends('layouts.app')

@section('content')
<h1>Edit Course</h1>

<form action="{{ route('courses.update', $course->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Course Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $course->name) }}" required>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description">{{ old('description', $course->description) }}</textarea>
    
    <!-- Add other fields as needed -->

    <button type="submit">Update Course</button>
</form>
@endsection
