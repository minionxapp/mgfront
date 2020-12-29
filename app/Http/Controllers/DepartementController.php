<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Divisi;
use DataTables;
use Auth;
class DepartementController extends Controller
{
    

  
    
    
    public function departement()
        {
            $divisi = Divisi::All();
            return view('departement',['divisi'=>$divisi]);
        }
    
    public function allDepartement()
        {        
            return Datatables::of(Departement::all())
            ->addColumn('action', function($row){       
                $btn = '<a href="#" onclick="viewFunction(\''.$row->id.'\');" class="edit btn btn-info btn-sm">View</a> ';
                $btn = $btn.' <a href="#" onclick="editFunction(\''.$row->id.'\');" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn = $btn.' <a href="/delDepartement/'.$row->id.'" class="edit btn btn-danger btn-sm" onclick="return confirm(\'Yakin mau dihapus\');">Delete</a>';
                return $btn;
            })
            ->addColumn('nama_divisi', function($row){  
                $departement =$row->divisi->nama;
                return $departement;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    
    
    public function addDepartement(Request $request)
        {
            $departement = new Departement;
            if($request->id == null ){
                // 'kode','nama','nik_kadept','nama_kadept','divisi_kode','create_by','update_by'];
                $departement->kode = $request->kode;
                $departement->nama = $request->nama;
                $departement->nik_kadept = $request->nik_kadept;
                $departement->nama_kadept = $request->nama_kadept;
                $departement->divisi_kode = $request->divisi_kode;
                $departement->create_by = Auth::user()->user_id;
                $departement->save();
                return redirect('/departement')->with('sukses','Data Berhasil di Simpan');
            }else{
                $departementUpdate = Departement::find($request->id);
                $departementUpdate->update_by = Auth::user()->user_id;
                $departementUpdate->update($request->all());
                return redirect('/departement')->with('sukses','Update Berhasil di Simpan');
            }
        }
    
        public function getDepartementById($id){
            $departement = Departement::find($id);
            return $departement;
        }
    
    
        public function delDepartement($id)
        {
            $departement = Departement::find($id);
            $departement->delete();
            return redirect('/departement')->with('sukses','Data Berhasil dihapus');            
        }
        
    
        public function getDepartementByDivisi($divisi_kode)
        {
            $role = Auth::user()->roles;
            // dd($role);
            if(Auth::user()->hasRole('admin')){
                $departement = Departement::where('divisi_kode','=',$divisi_kode)->get();
                return json_encode($departement);
            }
            else{
                $departement = Departement::where('kode','=',Auth::user()->departemen)->get();;
                return json_encode($departement);
            }
        }

    
}
