<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Usulan;
use DataTables;
use Auth;
use Carbon;

// model
// Model
// 'no_srt','deskripsi','unit_usul','status','file_usul','file_usul_link','file_dispo',
// 'file_dispo_link','comment','deadline','jenis_usul','pic_usul','no_pic_usul',
// 'asign_to','pic_asign_to','asign_desc','create_by','update_by',   

class UsulanController extends Controller
{
public function usulan()
    {
        return view('usulan');
    }

public function allUsulan()
    {        
        return DataTables::of(Usulan::all())
        ->addColumn('action', function($row){       
            $btn = '<a href="#" onclick="viewFunction(\''.$row->id.'\');" class="edit btn btn-info btn-sm">View</a> ';
            $btn = $btn.' <a href="#" onclick="editFunction(\''.$row->id.'\');" class="edit btn btn-primary btn-sm">Edit</a>';
            $btn = $btn.' <a href="/delUsulan/'.$row->id.'" class="edit btn btn-danger btn-sm" onclick="return confirm(\'Yakin mau dihapus\');">Delete</a>';
            return $btn;        })
        ->rawColumns(['action'])
        ->make(true);
    }


public function addUsulan(Request $request)
    {
            $usulan = new Usulan;
            $usulan->no_srt = $request->no_srt;
            $usulan->deskripsi = $request->deskripsi;
            $usulan->unit_usul = $request->unit_usul;
            $usulan->status = $request->status;
           
            $usulan->file_usul_link = $request->file_usul_link;
            $usulan->file_dispo_link = $request->file_dispo_link;
            $usulan->comment = $request->comment;
            // $usulan->deadline = $request->deadline;
            $usulan->mulai = $request->mulai;
            $usulan->selesai = $request->selesai;
            
            $usulan->jenis_usul = $request->jenis_usul;
            $usulan->pic_usul = $request->pic_usul;
            $usulan->no_pic_usul = $request->no_pic_usul;
            $usulan->asign_to = $request->asign_to;
            $usulan->pic_asign_to = $request->pic_asign_to;
            $usulan->asign_desc = $request->asign_desc;
            
            if($request->hasfile('file_usul')){
                $request->file('file_usul')
                ->move('images/usul/',Carbon\Carbon::now()->timestamp.'_'.($request->file('file_usul')->getClientOriginalName()));
                $usulan->file_usul =Carbon\Carbon::now()->timestamp.'_'.($request->file('file_usul')->getClientOriginalName());//$request->file1;
            }
            
            if($request->hasfile('file_dispo')){
                $request->file('file_dispo')
                ->move('images/usul/',Carbon\Carbon::now()->timestamp.'_'.($request->file('file_dispo')->getClientOriginalName()));
                $usulan->file_dispo =Carbon\Carbon::now()->timestamp.'_'.($request->file('file_dispo')->getClientOriginalName());//$request->file1;
            }


            if($request->id == null ){    
                $usulan->create_by = Auth::user()->user_id;
                $usulan->save();
                return redirect('/usulan')->with('sukses','Data Berhasil di Simpan');
            }else{
                $usulanUpdate = Usulan::find($request->id);
                $usulanUpdate->update_by = Auth::user()->user_id;
                $usulanUpdate->update($usulan->toArray());
                return redirect('/usulan')->with('sukses','Update Berhasil di Simpan');
            }
    }

    public function getUsulanById($id){
        $usulan = Usulan::find($id);
        return $usulan;
    }


    public function delUsulan($id)
    {
        $usulan = Usulan::find($id);
        $usulan->delete();
        return redirect('/usulan')->with('sukses','Data Berhasil dihapus');
        
    }
    

}
