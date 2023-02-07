<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Add event</title>
</head>
<body>
    <div class="container" style="margin-top-20px">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Event</h2>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <form method="post" action="{{url('save-event')}}">
                    @csrf
                    <div class="md-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="md-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="desc" required></textarea>
                    </div>
                    <div class="md-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="sdate" required>
                    </div>
                    <div class="md-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control" name="edate" required>
                    </div><div class="md-3">
                        <label class="form-label">Remarks</label>
                        <input type="text" class="form-control" name="remarks">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/')}}" class="btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>    
</body>
</html>