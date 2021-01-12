<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GleadsModul;

class Rep01Controller extends Controller
{
    public function rep01()
    {
        $programs = GleadsModul::distinct()->get(['program_name']);
        // ,['divisi'=>$divisi]
        return view('rep01',['program'=>$programs]);
    }

    public function getProgram(){
        $programs = GleadsModul::distinct()->get(['program_name']);
        return $programs;
    }

    public function getSkillByProgram($program,$tahun){
        $skills = GleadsModul::where('program_name','=',$program)
        ->where('tahun','=',$tahun)
        ->distinct()->get(['skill_name']);
        return $skills;
    }

    public function getmodulBySkill($program,$skill){
        $modul = GleadsModul::where('program_name','=',$program)
        ->where('skill_name','=',$skill)
        ->distinct()->get(['modul_name']);
        return $modul;
    }
}
