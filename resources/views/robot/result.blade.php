@extends('layouts.master')

@section('title')
   We are the robots - result
@endsection

@section('content')
<div class="container-fluid">

<ul class="list-group">
  <li class="list-group-item">Match #{{ $history->id }}:Winner is ... {{ $winner->name }}(id: {{ $winner->id }})</li>
  <li class="list-group-item">Your robot: {{$robot->name}}(id: {{ $robot->id }})</li>
  <li class="list-group-item">Opponent robot: {{$opponent->name}}(id: {{ $opponent->id }})</li>
</ul>

<div class="alert alert-warning" role="alert"> {{ $robot->name }} can challange another robot {{ $challange }} times today. <a href="{{ route('robot.fight') }}">back to lobby</a></div>
</div>
@endsection
