@extends('layouts.dashboard')
@section('form-link')
  <li>
    <a href="{{ route('form.show') }}">Form 1</a>
  </li> 
@endsection
@section('user-info')
    <h4 class="page-title">Welcome, {{ Auth::user()->employee->firstname . ' ' . Auth::user()->employee->lastname }}</h4>
@endsection
