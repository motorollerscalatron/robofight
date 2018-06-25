@extends('layouts.master')

@section('title')
   We are the robots - my robots
@endsection

@section('content')
<div class="container">

<div id="my robots">

    <div class="panel panel-default">
        <div class="panel-heading">My robots
        <div class="pull-right">
            <a href="{{ route('robot.create') }}" class="btn btn-primary btn-sm">Add</a>
{{--            <a href="{{ route('robot.create') }}" class="btn btn-primary btn-sm">Import</a>--}}
            <form action ="{{ url('/robot/upload') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
       {{-- <div class="form-group">--}}
       {{-- <label for="upload-file">Upload</label> --}}
            <input type="file" name="upload-file" class="form-control">
        {{--</div> --}}
            <input class="btn btn-success" type="submit" value="Upload" name="submit">
            </form>
        </div>
        </div>

        <!-- Table -->
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Speed</th>
                <th>Weight</th>
                <th>Power</th>
                <th> - </th>
                <th> - </th>                
            </tr>

            @foreach($robots as $post)
            <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['name'] }}</td>
                    <td>{{ $post['speed'] }}</td>
                    <td>{{ $post['weight'] }}</td>
                    <td>{{ $post['power'] }}</td>
                    <td>
                        <a href="{{action('RobotController@edit', $post['id'])}}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                    <form action="{{action('RobotController@destroy', $post['id'])}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                    </td>
            </tr>
            @endforeach

        </table>
    </div>
</div>
@endsection
