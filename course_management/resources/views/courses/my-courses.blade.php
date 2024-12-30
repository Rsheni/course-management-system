@extends('layout')

@section('content')
<h2>My Enrolled Courses</h2>
<ul>
    @foreach($courses as $course)
    <li>
        {{ $course->name }}
        (Instructor: {{ $course->instructor->name }})
        <a href="{{ route('courses.show', $course->id) }}">View</a>
    </li>
    @endforeach
</ul>
@endsection