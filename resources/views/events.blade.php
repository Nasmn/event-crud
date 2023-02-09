<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Events List</h1>
        <a href="javascript:void(0)" class="btn btn-success" id="createNewEvent">Add</a>
        <table class="table table-bordered data-table">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Remarks</th>
                <th>Action</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="eventForm" name="eventForm" class="form-horizontal">
                        <input type="hidden" name="event_id" id="event_id">
                        <div class="form-group">
                            Title:<br>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Event Title" required value="">
                        </div><div class="form-group">
                            Description:<br>
                            <input type="text" class="form-control" id="desc" name="desc" placeholder="Enter Event Description" required value="">
                        </div>
                        <div class="form-group">
                            Start Date:<br>
                            <input type="date" class="form-control" id="sDate" name="sDate" placeholder="" required value="">
                        </div>
                        <div class="form-group">
                            End Date:<br>
                            <input type="date" class="form-control" id="eDate" name="eDate" placeholder="" required value="">
                        </div>
                        <div class="form-group">
                            Remarks:<br>
                            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks(if any)" value="">
                        </div><br>
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
</body>
<script type="text/javascript">
$(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    var table = $(".data-table").DataTable({
        searching:false,
        paging:false,
        order: [3, 'asc'],
        serverSide:true,
        processing:true,
        ajax:"{{route('events.index')}}",
        columns:[
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data:'title', name:'title'},
            {data:'description', name:'description'},
            {data:'start_date', name:'start_date'},
            {data:'end_date', name:'end_date'},
            {data:'remarks', name:'remarks'},
            {data:'action', name:'action'},
        ]
    });
    $("#createNewEvent").click(function(){
        $('#event_id').val('');
        $('#eventForm').trigger("reset");
        $('#modalHeading').html('Add Event');
        $('#ajaxModal').modal('show');
    });
    $("#saveBtn").click(function(e){
        e.preventDefault();
        $(this).html('Save');

        $.ajax({
            data:$("#eventForm").serialize(),
            url:"{{route('events.store')}}",
            type:"POST",
            dataType:"json",
            success:function(data){
                $("#eventForm").trigger("reset");
                $("#ajaxModal").modal('hide');
                table.draw();
            },
            error:function(data){
                console.log('Error:', data);
                $("#saveBtn").html('Save');
            }
        });
    });
    $('body').on('click', '.deleteEvent', function(){
        var event_id = $(this).data("id");
        if(confirm("Are you sure want to delete?")){   
            $.ajax({
                type:"DELETE",
                url:"{{route('events.store')}}"+'/'+event_id,
                success:function(data){
                    // $("#eventForm").trigger("reset");
                    // $("#ajaxModal").modal('hide');
                    table.draw();
                },
                error:function(data){
                    console.log('Error:', data);
                    // $("#saveBtn").html('Save');
                }
            });
        }
    });
    $('body').on('click', '.editEvent', function(){
        var event_id = $(this).data("id");
        $.get("{{route('events.index')}}"+"/"+event_id+"/edit", function(data){
        //    console.log(data)
            $("#modalHeading").html("Edit Event");
            $('#ajaxModal').modal('show');
            $("#event_id").val(data.id);
            $("#title").val(data.title);
            $("#desc").val(data.description);
            $("#sDate").val(data.start_date);
            $("#eDate").val(data.end_date);
            $("#remarks").val(data.remarks);
        });
    });
    });
</script>
</html>