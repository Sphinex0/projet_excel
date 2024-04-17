<?php

namespace App\Http\Controllers;

use App\Imports\EFPImport;
use App\Imports\FiliereImport;
use App\Imports\FormateurImport;
use App\Imports\GroupeImport;
use App\Imports\ModuleImport;
use App\Imports\multiImport;
use App\Imports\PresentielImport;
use App\Imports\SecteurImport;
use App\Imports\SousGroupeImport;
use App\Imports\SynchImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    //
    public function store(Request $request){
        set_time_limit(0);
        $file=$request->file("imported_file");


        Excel::import(new multiImport, $file);
        return "success";
    }
}
