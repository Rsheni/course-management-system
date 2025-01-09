@extends('layout')

@section('content')
<h1>Welcome, {{ Auth::check() ? Auth::user()->name : 'Guest' }}!</h1>
<p>This is your simple learning and management system</p>
@endsection