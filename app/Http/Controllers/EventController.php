<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(){
        $data = Event::get();
        return view('event-list', compact('data'));
    }
    public function addEvent(){
        return view('add-event');
    }
    public function saveEvent(Request $request){
        $request->validate([
            'title' =>'required',
            'desc' =>'required',
            'sdate'=> 'date|required',
            'edate'=> 'required|date|after_or_equal:sdate',
            'remarks'=>'nullable'
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->desc;
        $event->start_date = $request->sdate;
        $event->end_date = $request->edate;
        $event->remarks = $request->remarks;
        $event->save(); 
        return redirect('/')->with('success', 'Event added Successfully');
    }
    public function editEvent($id){
        $data = Event::where('id','=',$id)->first();
        // return $data;
        return view('edit-event', compact('data'));
    }
    public function updateEvent(Request $request){
        $request->validate([
            'title' =>'required',
            'desc' =>'required',
            'sdate'=> 'date|required',
            'edate'=> 'required|date|after_or_equal:sdate',
            'remarks'=>'nullable'
        ]);
        $id = $request->id;
        $title = $request->title;
        $desc = $request->desc;
        $start_date = $request->sdate;
        $end_date = $request->edate;
        $remarks = $request->remarks;

        Event::where('id','=',$id)->update([
            'title'=>$title,
            'description'=>$desc,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'remarks'=>$remarks
        ]);
        return redirect('/')->with('success', 'Event Updated Successfully');
    }
    public function deleteEvent($id){
        Event::where('id',$id)->delete();

        return response()->json([
            'result'=>'Record Deleted Successfully'
        ]);
    }
}
