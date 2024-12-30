@extends('layout')

@section('content')
<h2>Create a New Course</h2>
<form action="{{ route('courses.store') }}" method="POST">
    @csrf
    <label>Course Name:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <br>

    <label>Description:</label>
    <textarea name="description" required>{{ old('description') }}</textarea>
    <br>

    <label>Subject:</label>
    <input type="text" name="subject" value="{{ old('subject') }}" required>
    <br>

    <label>Enrollment Key (4 digits):</label>
    <input type="text" name="enrollment_key" value="{{ old('enrollment_key') }}" required maxlength="4">
    <br><br>

    <button type="submit">Create Course</button>
</form>
@endsection