<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use App\Report;
use Validator;
use Auth;

use Yajra\Datatables\Facades\Datatables;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index')->with('page_title','Reported Videos');
    }

    public function destroy($id)
    {
        $report = Report::findOrfail($id);
        $report->delete();
        return redirect()->back()->withSuccess('Successfully deleted.');
    }

    public function get(Request $request)
    {
        if ($request->ajax()) {
            $reports = Report::select()->orderBy('created_at','DESC');
            return Datatables::of($reports)   
                ->addColumn('check',function($report){
                    return '<input type="checkbox" class="check" name="check[]" value="'.$report->id.'" data-videoid="'.$report->video_id.'">';
                })
               ->addColumn('video',function($report){
                    if(isset($report->video)) return '<a target="_blank" href="'.$report->video->url.'">'.$report->video->title.'</a>';
                    else return 'deleted video';
                })                
               ->addColumn('user',function($report){
                    if(isset($report->user)) return '<a target="_blank" href="'.url('admin/users/'.$report->user->id.'/edit').'">'.$report->user->name.'</a>';
                    else return 'deleted user';
                })                       
                ->addColumn('action', function($report){
                    $action = '<a class="btn btn-xs btn-default" href="'.url('admin/reported-videos/'.$report->id.'/delete').'"><i class="fa fa-trash"></i> Delete Report</a>';
                    if(isset($report->video)) $action .= '<a class="btn btn-xs btn-default" href="'.url('admin/videos/'.$report->video->id.'/delete').'"><i class="fa fa-trash"></i> Delete Video</a>';

                    return $action;
                })
            ->make(true);
        }
    }

    public function deleteSelected(Request $request)
    {
        if(!empty($request->ids)){
            $reports = Report::whereIn('id',$request->ids)->delete();
            echo "success";
        }
        else{
            echo "error";
        }        
    }
  
}