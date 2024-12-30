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

        @if(Auth::id() === $course->instructor_id)
            <!-- Button to delete the course -->
            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Course</button>
            </form>
        @endif
    </li>
    @endforeach
</ul>
@endsection