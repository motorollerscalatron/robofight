@extends('layouts.master')

@section('title')
   We are the robots | home
@endsection

@section('content')

<div id="publicresults">
    <div class="panel panel-default">

        <!-- Default panel contents -->
        <div class="panel-heading">Latest 5 Fighting Results</div>

        <!-- Table -->
        <table class="table">
        <tr>
        <th>Player1</th>
        <th>Player2</th>
        <th>Winner</th>
        </tr>
        @foreach ($histories as $history)
            <tr>
                <td>{{ $history->playera()->withTrashed()->getResults()->name }}(ID:{{ $history->playera()->withTrashed()->getResults()->id  }})</td>
                <td>{{ $history->playerb()->withTrashed()->getResults()->name }}(ID:{{ $history->playerb()->withTrashed()->getResults()->id  }})</td>
                <td>{{ $history->winner()->withTrashed()->getResults()->name }}(ID:{{ $history->winner()->withTrashed()->getResults()->id  }})</td>
            </tr>
        @endforeach
        </table>

    </div>

</div>

<div id="top10">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Top 10 Robots</div>

        <!-- Table -->
        <table class="table">
            <tr>
                <th>Robot name(id)</th>
                <th>Fights</th>
                <th>Wins</th>
                <th>Losses</th>                
            </tr>

        @foreach ($robots as $robot)
            <tr>
                <td>{{ $robot->name }}(ID:{{ $robot->id }})</td>
                <td>{{ $robot->fight }}</td>
                <td>{{ $robot->win }}</td>
                <td>{{ $robot->lose }}</td>
            </tr>
        @endforeach
        </table>
    
    </div>

</div><!-- end of top10 block -->

@endsection
