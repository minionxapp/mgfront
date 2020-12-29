<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function script()
    {
        return view('script');
    }

    public function scriptView($param)
    {
        $script = "
        @extends('adminlte::page')
        @section('title', 'Dashboard') 
            
        @section('content_header')
        
        &lt;section class=\"content-header\"&gt;
        &lt;div class=\"container-fluid\"&gt;
        &lt;div class=\"row mb-2\"&gt;
        &lt;div class=\"col-sm-6\"&gt;
        &lt;h1&gt;Judul&lt;/h1&gt;
        &lt;/div&gt;
        &lt;div class=\"col-sm-6\"&gt;
        &lt;ol class=\"breadcrumb float-sm-right\"&gt;
            &lt;li class=\"breadcrumb-item\"&gt;&lt;a href=\"#\"&gt;Home&lt;/a&gt;&lt;/li&gt;
            &lt;li class=\"breadcrumb-item active\"&gt;User Profile&lt;/li&gt;
        &lt;/ol&gt;
        &lt;/div&gt;
            &lt;/div&gt;
            &lt;/div&gt;&lt;!-- /.container-fluid --&gt;
        &lt;/section&gt;

        @section('content')
            &lt;div&gt;
                @if (session('sukses'))
                &lt;div class=\"alert alert-primary\" role=\"alert\"&gt;
                    {{session('sukses')}}
                &lt;/div&gt;
                @endif
            &lt;/div&gt;

        &lt;div class=\"row text-nowrap\"&gt;
            &lt;div class=\"col-12\" style=\"padding-top: 5px;\"&gt;
                &lt;button type=\"button\" class=\"btn btn-primary btn-sm float-left\"  
                    data-toggle=\"modal\" onclick=\"addFunction();\" &gt;Add
                &lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;

        &lt;div&gt;  
            &lt;table id=\"myTable\" class=\"display nowrap\" style=\"width:100%\"&gt;
                &lt;thead&gt;                
            ";

        $objParam =    json_decode($param);
        $table = $objParam->table;
        $col = '';
        foreach (($objParam)->colum as $column) {
            $col = $col . "&lt;th&gt; " . $column->column . "&lt;/th&gt;\n";
        }
        $script = $script . $col;
        $script = $script . "&lt;th&gt;Action&lt;/th&gt;\n&lt;/table&gt;\n&lt;/div&gt";

        $modal = "    &lt;div class=\"modal fade\" id=\"formData\" data-backdrop=\"static\" tabindex=\"-1\" role=\"dialog\"
        aria-labelledby=\"addDataLabel\" aria-hidden=\"true\"&gt;
            &lt;div class=\"modal-dialog\" role=\"document\"&gt;
            &lt;div class=\"modal-content\"&gt;
                &lt;div class=\"modal-header\"&gt;
                &lt;h5 class=\"modal-title\" id=\"staticBackdropLabel\"&gt;Data User&lt;/h5&gt;
                &lt;button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"&gt;
                    &lt;span aria-hidden=\"true\"&gt;&times;&lt;/span&gt;
                &lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=\"modal-body\"&gt;
                    &lt;form action=\"/add".$table."\" method=\"POST\"&gt;
                        {{ csrf_field() }}\n";

        $script = $script . $modal;

        $col2 = '';
        foreach (($objParam)->colum as $column) {
            $col2 = $col2 . "&lt;div class=\"form-group\"&gt;
            &lt;label for=\"".$column->column."\"&gt;".$column->column."&lt;/label&gt
            &lt;input type=\"text\" name=\"" . $column->column . "\" class=\"form-control\" id=\"" . $column->column . "\"&gt;
            &lt;/div&gt;\n";
        }

        $script = $script . $col2;
        $footer = " &lt;div class=\"modal-footer\"&gt;
        &lt;button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\"&gt;Close&lt;/button&gt;
        &lt;button type=\"submit\" id=\"btnsubmit\" class=\"btn btn-primary\"&gt;Submit&lt;/button&gt;
        &lt;/div&gt;
        &lt;/form&gt;
        &lt;/div&gt;
        &lt;/div&gt;
        &lt;/div&gt;
        &lt;/div&gt;
        @stop

        @section('css')
            &lt;link rel=\"stylesheet\" href=\"/css/app.css\"&gt;
        @stop
        @section('js')
        &lt;script&gt;
        $(document).ready(function() {
            awal();
        });
        function awal() {
            $('#myTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/all".$table."',
                columns: [
        ";

        $col3 = '';
        foreach (($objParam)->colum as $column) {
            $col3 = $col3 . "{ data: '" . $column->column . "', name: '" . $column->column . "' },  \n";
        }
        $col3 = $col3 . "{data: 'action', name: 'action', orderable: false, searchable: false}
                ]});}";

        $add = "function addFunction() {";
        foreach (($objParam)->colum as $column) {
            $add = $add . "$('#" . $column->column . "').attr('readonly', true); \n";
        }

        foreach (($objParam)->colum as $column) {
            $add = $add . "$('#" . $column->column . "').val(''); \n";
        }
        $add = $add . " $('#formData').modal('show'); 
                readonly(false)      ; \n}";

        $view = "async function viewFunction(\$id) {
        readonly(true)      ;  
        $.ajax({
       type:'GET',
       async: false,
       url:'/get" .$table. "ById/'+\$id, 
       success:function(data) {";
        foreach (($objParam)->colum as $column) {
            $view = $view . "$('#" . $column->column . "').val(data." . $column->column . "); \n";
        }
        $view = $view . "$('#btnsubmit').prop(\"disabled\",true); \n
            }\n
        }); \n
        $('#formData').modal('show'); \n}\n
        async function editFunction(\$id) {    
            await viewFunction(\$id);
            $('#id').attr('readonly', true);        
            $('#btnsubmit').prop(\"disabled\",false); 
            readonly(false)      ; 
        }

        function readonly(params) {
          ";
        foreach (($objParam)->colum as $column) {
            $view = $view . "$('#" . $column->column . "').attr('readonly', params); ";
        }
        $view = $view . " }\n
          &lt;/script&gt;\n
      @stop";

        $script = $script . $footer . $col3 . $add . $view;
        return ($script);
    }

    public function scriptController($param){
        $objParam =    json_decode($param);
        $table = $objParam->table;
        $col = '';
        foreach (($objParam)->colum as $column) {
            $col = $col . "&lt;th&gt; " . $column->column . "&lt;/th&gt;\n";
        }
        $script ="&lt;?php
        namespace App\Http\Controllers;

            use Illuminate\Http\Request;
            use App\\Models\\".$table.";
            use DataTables;
            use Auth;
            use Carbon;
            class ".$table."Controller extends Controller
            {

            public function ".$table."()
            {
                return view('".strtolower($table)."');
            }
            public function all".$table."()
            {        
                return Datatables::of(".$table."::all())
                -&gt;addColumn('action', function(\$row){       
                    \$btn = '&lt;a href=\"#\" onclick=\"viewFunction(\''.\$row-&gt;id.'\');\" class=\"edit btn btn-info btn-sm\"&gt;View&lt;/a&gt; ';
                    \$btn = \$btn.' &lt;a href=\"#\" onclick=\"editFunction(\''.\$row-&gt;id.'\');\" class=\"edit btn btn-primary btn-sm\"&gt;Edit&lt;/a&gt;';
                    \$btn = \$btn.' &lt;a href=\"/del".$table."/'.\$row-&gt;id.'\" class=\"edit btn btn-danger btn-sm\" onclick=\"return confirm(\'Yakin mau dihapus\');\"&gt;Delete&lt;/a&gt;';
                    return \$btn;        })
                -&gt;rawColumns(['action'])
                -&gt;make(true);
            }

            public function add".$table."(Request \$request)
            {
                \$model = new ".$table.";
                if(\$request-&gt;id == null ){
                    ";
                    foreach (($objParam)->colum as $column) {
                        $script = $script. "\$model-&gt;".$column->column." = \$request-&gt".$column->column.";";
                    }
                    
                    $script = $script."
                    \$model-&gt;create_by = Auth::user()-&gt;user_id;
                    \$model-&gt;save();
                    return redirect('/".strtolower($table)."')-&gt;with('sukses','Data Berhasil di Simpan');
                }else{
                    \$modelUpdate = ".$table."::find(\$request-&gt;id);
                    \$modelUpdate-&gt;update_by = Auth::user()-&gt;user_id;
                    \$modelUpdate-&gt;update(\$request-&gt;all());
                    return redirect('/".strtolower($table)."')-&gt;with('sukses','Update Berhasil di Simpan');
                }
            }

            public function get".$table."ById(\$id){
                \$model = $table::find(\$id);
                return \$model;
            }

            public function del".$table."(\$id)
            {
                \$model = ".$table."::find(\$id);
                \$model-&gt;delete();
                return redirect('/".strtolower($table)."')-&gt;with('sukses','Data Berhasil dihapus');
                
            }
        }

        ";

        return($script);

    }

    public function scriptRoute($param){
        $objParam =    json_decode($param);
        $table = $objParam->table;
        $route ="        
        //TEST SCRIP GENERATOR
        Route::get('/".strtolower($table)."', [App\Http\Controllers\\".$table."Controller::class, '".$table."'])->name('".strtolower($table)."');
        Route::get('/all".$table."', [App\Http\Controllers\\".$table."Controller::class, 'all".$table."'])->name('all".$table."');
        Route::post('/add".$table."', [App\Http\Controllers\\".$table."Controller::class, 'add".$table."'])->name('add".$table."');
        Route::get('/get".$table."ById/{id}', [App\Http\Controllers\\".$table."Controller::class, 'get".$table."ById'])->name('get".$table."ById');
        Route::get('/del".$table."/{id}', [App\Http\Controllers\\".$table."Controller::class, 'del".$table."'])->name('del".$table."');
        ";
        return ($route);
 
    }
}
