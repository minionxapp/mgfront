<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use DataTables;
use Auth;

class DivisiController extends Controller
{
    public function divisi()
    {
        return view('/admin/divisi');
    }

    public function allDivisi()
    {        
        return Datatables::of(Divisi::all())
        ->addColumn('action', function($row){       
            $btn = '<a href="#" onclick="viewFunction(\''.$row->id.'\');" class="edit btn btn-info btn-sm">View</a> ';
            $btn = $btn.' <a href="#" onclick="editFunction(\''.$row->id.'\');" class="edit btn btn-primary btn-sm">Edit</a>';
            $btn = $btn.' <a href="/delDivisi/'.$row->id.'" class="edit btn btn-danger btn-sm" onclick="return confirm(\'Yakin mau dihapus\');">Delete</a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }



    public function addDivisi(Request $request){
        // 'kode','nama','nik_kadiv','nama_kadiv',
        $model = new Divisi;
        $model->kode = $request->kode;
        $model->nama = $request->nama;
        $model->nik_kadiv = $request->nik_kadiv;
        $model->nama_kadiv = $request->nama_kadiv;
        if($request->id == null ){
            $model->create_by = Auth::user()->user_id;
            $model->save();
            return redirect('/divisi')->with('sukses','Data Berhasil di Simpan');
        }else{
            // $modelUpdate = new Divisi;;
            $modelUpdate = Divisi::find($request->id);
            $modelUpdate->update_by = Auth::user()->user_id;
            $modelUpdate->update($request->all());
            return redirect('/divisi')->with('sukses','Update Berhasil di Simpan');
        }
    }

    public function getDivisiById($id){
        $divisi = Divisi::find($id);
        return $divisi;
    }

    public function delDivisi($id)
    {
        $model = Divisi::find($id);
        $model->delete();
        return redirect('/divisi')->with('sukses','Data Berhasil dihapus');
        
    }
    

    public function getAllDivisi(){
        $divisi = Divisi::all();
        return json_encode($divisi);

    }


}
