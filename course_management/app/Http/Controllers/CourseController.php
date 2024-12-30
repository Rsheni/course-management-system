<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Show all courses (student sees them, but cannot view details if not enrolled)
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    // For instructor to create a course
    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'subject' => 'required',
            'enrollment_key' => 'required|digits:4',
        ]);

        Course::create([
            'instructor_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'subject' => $request->subject,
            'enrollment_key' => $request->enrollment_key,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    // Show the course details if the user is the instructor or the user has enrolled
    public function show(Course $course)
    {
        // if the user is the instructor or if the user is enrolled in the course
        if (Auth::user()->id === $course->instructor_id || $course->students->contains(Auth::id())) {
            return view('courses.show', compact('course'));
        }

        return abort(403, 'You are not enrolled in this course.');
    }

    // Enroll a student
    public function enrollForm($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.enroll', compact('course'));
    }

    public function enroll(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $request->validate([
            'enrollment_key' => 'required',
        ]);

        if ($course->enrollment_key === $request->enrollment_key) {
            // attach user to course
            $course->students()->attach(Auth::id());
            return redirect()->route('courses.show', $course->id)
                ->with('success', 'Enrolled successfully!');
        }

        return redirect()->back()->withErrors(['enrollment_key' => 'Invalid enrollment key.']);
    }

    // List all courses in which the student is enrolled
    public function myCourses()
    {
        $courses = Auth::user()->courses;
        return view('courses.my-courses', compact('courses'));
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        
        // Only allow the instructor to delete their course
        if (Auth::user()->id === $course->instructor_id) {
            $course->delete();
            return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
        }

        return redirect()->route('courses.index')->with('error', 'You are not authorized to delete this course.');
    }


    public function confirmDelete(Course $course)
    {
        // Check if the user is the instructor of the course
        if (Auth::id() !== $course->instructor_id) {
            return abort(403, 'Unauthorized action.');
        }

        return view('courses.delete', compact('course'));
    }
}