@extends('layouts.master')

@section('title')
   We are the robots - create a robot
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Robot</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('robot') }}">
                        {{ csrf_field() }}
			{{-- <input name="_method" type="hidden" value="PATCH"> --}}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
{{--
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
--}}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                            <label for="weight" class="col-md-4 control-label">Weight</label>

                            <div class="col-md-6">
                                <input id="weight" type="text" class="form-control" name="weight" value="{{ old('weight') }}" required>
{{--
                                @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
--}}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('power') ? ' has-error' : '' }}">
                            <label for="power" class="col-md-4 control-label">Power</label>

                            <div class="col-md-6">
                                <input id="power" type="text" class="form-control" name="power" value="{{ old('power') }}" required>
{{--
                                @if ($errors->has('power'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('power') }}</strong>
                                    </span>
                                @endif
--}}
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('speed') ? ' has-error' : '' }}">
                            <label for="speed" class="col-md-4 control-label">Speed</label>

                            <div class="col-md-6">
                                <input id="speed" type="text" class="form-control" name="speed" value="{{ old('speed') }}" required>
{{--
                                @if ($errors->has('speed'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('speed') }}</strong>
                                    </span>
                                @endif
--}}

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="avatar" class="col-md-4 control-label">Avatar</label>

                            <div class="col-md-6">
                                <input id="avatar" type="text" class="form-control" name="avatar" value="{{ old('avatar') }}" required>
{{--
                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
--}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
