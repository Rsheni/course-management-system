@extends('layout')

@section('content')
<h1>Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}!</h1>
<p>This is a simple Laravel RBAC example with Admin, Instructor, and Student roles.</p>
@endsection