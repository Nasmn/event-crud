<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Event List</title>
</head>
<body>
    <div class="container" style="margin: top 20px;">
        <div class="row">
            <div class="col-md-12">
                <h2>Event list</h2>
                <div style="display: inline-block">
                    <a href="{{url('add-event')}}" class="btn btn-success">Add</a>
                </div>
                <div class="dropdown" style="display:inline-block">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Filter
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Current Events</a></li>
                      <li><a class="dropdown-item" href="#">Upcoming Events</a></li>
                      <li><a class="dropdown-item" href="#">Finished Events</a></li>
                    </ul>
                  </div>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <div id="message" style="color: red"></div>
                <table id="event-table">
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
                        $data = DB::table('events')
                        ->orderBy('start_date')
                        ->get();
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
                            <td><a href="{{url('edit-event/'.$event->id)}}" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger delete" data-id
                            ="{{$event->id}}">Delete</button>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        $("#event-table").on("click",".delete", function() {
           var id = ($(this).attr("data-id")); 
           var obj = $(this);
           $.ajax({
            type:"GET",
            url:"delete-event/"+id,
            success:function(data){
                $(obj).parent().parent().remove();
                $("#message").text(data.result);
            }
           });
        });
    </script>
</body>
</html>