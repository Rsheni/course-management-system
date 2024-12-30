@extends('layout')

@section('content')
<h2>Course Details</h2>
<p><strong>Name:</strong> {{ $course->name }}</p>
<p><strong>Description:</strong> {{ $course->description }}</p>
<p><strong>Subject:</strong> {{ $course->subject }}</p>
<p><strong>Instructor:</strong> {{ $course->instructor->name }}</p>

<h3>Enrolled Students:</h3>
<ul>
    @foreach($course->students as $student)
    <li>{{ $student->name }} ({{ $student->email }})</li>
    @endforeach
</ul>
@endsection