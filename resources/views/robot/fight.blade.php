@extends('layouts.master')

@section('title')
   We are the robots - fight
@endsection

@section('content')
<div class="container-fluid">

<div id="my robots">

    <div class="panel panel-default">
        <div class="panel-heading">Fight
        </div>

        <div class="row">

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <div class="row placeholders">

            <form method="POST" action="{{ action('RobotController@submitFight') }}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <div class="col-xs-6 col-sm-3 placeholder">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="thumbnail1">
                <h4>My Robot</h4>
                      <select class="form-control" id="myrobot" name="myrobot">
                      <option value="">Select your robot</option>
                      @foreach ($robots as $robot)
                      <option value="{{ $robot->id }}">{{ $robot->name }}(id: {{ $robot->id }})</option>
                      @endforeach
                      </select>
            </div>
   
            <div class="col-xs-6 col-sm-3 placeholder text-center">
                VS
            </div>

            <div class="col-xs-6 col-sm-3 placeholder">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="thumbnail2">
                <h4>Your Opponent</h4>
                      <select class="form-control" id="opponent" name="opponent">
                      <option value="">Select an opponent</option>
                      @foreach ($opponents as $robot)
                      <option value="{{ $robot->id }}">{{ $robot->name }}(id: {{ $robot->id }})</option>
                      @endforeach
                      </select>
            </div>

                       <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Fight
                                </button>
                            </div>
                        </div>

            </form>
        </div>
        </div><!-- sm9 end  -->

        </div><!-- row  end -->

        <!-- status -->
        <div class="row">
            @if ($status == 1)
               Robot not found
            @elseif ($status == 2)
               This robot can't make a challenge today (max: 5 per day)  
            @elseif ($status == 3)
               A robot can't be challenged twice a day
            @endif
        </div>

    </div>
</div>
@endsection
