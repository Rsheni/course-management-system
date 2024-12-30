@extends('layout')

@section('content')
<h2>Enroll in {{ $course->name }}</h2>
<form action="{{ route('courses.enroll', $course->id) }}" method="POST">
    @csrf
    <label>Enrollment Key:</label>
    <input type="text" name="enrollment_key" required maxlength="4">
    <br><br>
    <button type="submit">Enroll</button>
</form>
@endsection