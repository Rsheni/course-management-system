@extends('layout')

@section('content')
<h2>Create a new user</h2>
<form action="{{ route('admin.storeUser') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <br>

    <label>Password:</label>
    <input type="password" name="password" required>
    <br>

    <label>Role:</label>
    <select name="role_id">
        @foreach($roles as $role)
        <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Create User</button>
</form>
@endsection