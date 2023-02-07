<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Event List</title>
</head>
<body>
    <div class="container" style="margin: top 20px;">
        <div class="row">
            <div class="col-md-12">
                <h2>Event list</h2>
                <div>
                    <a href="{{url('add-event')}}" class="btn btn-success">Add</a>
                </div>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <table class="table">
                    <thead><tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr></thead>
                    <tbody>
                        @php
                           $i = 1; 
                        @endphp
                        @foreach ($data as $event)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$event->title}}</td>
                            <td>{{$event->description}}</td>
                            <td>{{$event->start_date}}</td>
                            <td>{{$event->end_date}}</td>
                            <td>{{$event->remarks}}</td>
                            <td><a href="{{url('edit-event/'.$event->id)}}" class="btn btn-primary">Edit</a> <a href="{{url('delete-event/'.$event->id)}}" class="btn btn-danger"> Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>