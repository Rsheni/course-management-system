@extends('layout')

@section('content')
<h2>All Courses</h2>
<ul>
    @foreach($courses as $course)
    <li>
        {{ $course->name }}
        (Instructor: {{ $course->instructor->name }})
        |
        @if(Auth::user()->id === $course->instructor_id || $course->students->contains(Auth::id()))
        <a href="{{ route('courses.show', $course->id) }}">View Course</a>
        @else
        <a href="{{ route('courses.enrollForm', $course->id) }}">Enroll</a>
        @endif
    </li>
    @endforeach
</ul>
@endsection