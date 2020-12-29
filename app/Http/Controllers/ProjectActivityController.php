<?php
namespace App\Http\Controllers;

            use Illuminate\Http\Request;
            use App\Models\ProjectActivity;
            use DataTables;
            use Auth;
            use Carbon;
            class ProjectActivityController extends Controller
            {

            public function ProjectActivity()
            {
                return view('projectactivity');
            }
            public function allProjectActivity()
            {        
                return Datatables::of(ProjectActivity::all())
                ->addColumn('action', function($row){       
                    $btn = '<a href="#" onclick="viewFunction(\''.$row->id.'\');" class="edit btn btn-info btn-sm">View</a> ';
                    $btn = $btn.' <a href="#" onclick="editFunction(\''.$row->id.'\');" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn = $btn.' <a href="/delProjectActivity/'.$row->id.'" class="edit btn btn-danger btn-sm" onclick="return confirm(\'Yakin mau dihapus\');">Delete</a>';
                    return $btn;        })
                ->rawColumns(['action'])
                ->make(true);
            }

            public function addProjectActivity(Request $request)
            {
                $model = new ProjectActivity;
                if($request->id == null ){
                    $model->id = $request->id;$model->kd_activity = $request->kd_activity;$model->nm_activity = $request->nm_activity;$model->desc_activity = $request->desc_activity;$model->status = $request->status;$model->kd_project = $request->kd_project;$model->jenis = $request->jenis;$model->nm_project = $request->nm_project;$model->descripsi = $request->descripsi;$model->divisi = $request->divisi;$model->departement = $request->departement;$model->file1 = $request->file1;$model->file1_desc = $request->file1_desc;$model->file2 = $request->file2;$model->file2_desc = $request->file2_desc;$model->file3 = $request->file3;$model->file3_desc = $request->file3_desc;
                    $model->create_by = Auth::user()->user_id;
                    $model->save();
                    return redirect('/projectactivity')->with('sukses','Data Berhasil di Simpan');
                }else{
                    $modelUpdate = ProjectActivity::find($request->id);
                    $modelUpdate->update_by = Auth::user()->user_id;
                    $modelUpdate->update($request->all());
                    return redirect('/projectactivity')->with('sukses','Update Berhasil di Simpan');
                }
            }

            public function getProjectActivityById($id){
                $model = ProjectActivity::find($id);
                return $model;
            }

            public function delProjectActivity($id)
            {
                $model = ProjectActivity::find($id);
                $model->delete();
                return redirect('/projectactivity')->with('sukses','Data Berhasil dihapus');
                
            }
        }

        