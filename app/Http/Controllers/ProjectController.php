<?php
namespace App\Http\Controllers;

            use Illuminate\Http\Request;
            use App\Models\Project;
            use App\Models\Departement;
            use App\Models\Divisi;
            use DataTables;
            use Auth;
            use Carbon;
            class ProjectController extends Controller
            {

            public function Project()
            {
                return view('project');
            }
            public function allProject()
            {        
                return Datatables::of(Project::all())
                ->addColumn('action', function($row){       
                    $btn = '<a href="#" onclick="viewFunction(\''.$row->id.'\');" class="edit btn btn-info btn-sm">View</a> ';
                    $btn = $btn.' <a href="#" onclick="editFunction(\''.$row->id.'\');" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn = $btn.' <a href="/delProject/'.$row->id.'" class="edit btn btn-danger btn-sm" onclick="return confirm(\'Yakin mau dihapus\');">Delete</a>';
                    return $btn;        })
                ->rawColumns(['action'])
                ->make(true);
            }

            public function addProject(Request $request)
            {
                $model = new Project;
                if($request->id == null ){
                    $model->id = $request->id;$model->kd_project = $request->kd_project;
                    $model->nm_project = $request->nm_project;
                    $model->descripsi = $request->descripsi;
                    $model->divisi = $request->divisi;
                    $model->departement = $request->departement;
                    $model->jenis = $request->jenis;
                    $divisix = Divisi::where('kode','=',$request->divisi)->get()->first();
                    $model->nm_divisi = $divisix->nama;
                    // dd($divisix);
                    $model->nm_departement = (Departement::where('kode','=',$request->departement)->get()->first())->nama;;

                    $model->create_by = Auth::user()->user_id;
                    $model->save();
                    return redirect('/project')->with('sukses','Data Berhasil di Simpan');
                }else{
                    $modelUpdate = Project::find($request->id);
                    $modelUpdate->update_by = Auth::user()->user_id;
                    $modelUpdate->update($request->all());
                    return redirect('/project')->with('sukses','Update Berhasil di Simpan');
                }
            }

            public function getProjectById($id){
                $model = Project::find($id);
                return $model;
            }

            public function delProject($id)
            {
                $model = Project::find($id);
                $model->delete();
                return redirect('/project')->with('sukses','Data Berhasil dihapus');
                
            }
        }

        