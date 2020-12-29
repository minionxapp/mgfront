<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestScrip;
use DataTables;
use Auth;
use Carbon;

class TestScripController extends Controller
{

    public function TestScrip()
    {
        return view('testscrip');
    }
    public function allTestScrip()
    {
        return Datatables::of(TestScrip::all())
            ->addColumn('action', function ($row) {
                $btn = '<a href="#" onclick="viewFunction(\'' . $row->id . '\');" class="edit btn btn-info btn-sm">View</a> ';
                $btn = $btn . ' <a href="#" onclick="editFunction(\'' . $row->id . '\');" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn = $btn . ' <a href="/delTestScrip/' . $row->id . '" class="edit btn btn-danger btn-sm" onclick="return confirm(\'Yakin mau dihapus\');">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addTestScrip(Request $request)
    {
        $model = new TestScrip;
        if ($request->id == null) {
            $model->id = $request->id;
            $model->kode = $request->kode;
            $model->nama = $request->nama;
            $model->create_by = Auth::user()->user_id;
            $model->save();
            return redirect('/testscrip')->with('sukses', 'Data Berhasil di Simpan');
        } else {
            $modelUpdate = TestScrip::find($request->id);
            $modelUpdate->update_by = Auth::user()->user_id;
            $modelUpdate->update($request->all());
            return redirect('/testscrip')->with('sukses', 'Update Berhasil di Simpan');
        }
    }

    public function getTestScripById($id)
    {
        $model = TestScrip::find($id);
        return $model;
    }

    public function delTestScrip($id)
    {
        $model = TestScrip::find($id);
        $model->delete();
        return redirect('/testscrip')->with('sukses', 'Data Berhasil dihapus');
    }
}
