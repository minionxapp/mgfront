@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Rep01</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
    
@stop

@section('content')
    <div>
        @if (session('sukses'))
        <div class="alert alert-primary" role="alert">
            {{session('sukses')}}
        </div>
        @endif
    </div>

    <div class="row text-nowrap">
        <div class="col-12" style="padding-top: 5px;">
            {{-- <button type="button" class="btn btn-primary btn-sm float-left"  
                data-toggle="modal" onclick="addFunction();" >Add
            </button> --}}
            <form action="/search" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" class="form-control" id="tahun">
                            <option value="">Tahun</option>
                            <option value="2020">2020</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="program">Program</label>
                        <select name="program" class="form-control" id="program">
                            @foreach ($program as $item)
                            <option value="{{$item->program_name}}">{{$item->program_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="skill">Skill</label>
                        <select name="skill" class="form-control" id="skill">
                            @foreach ($program as $item)
                            <option value="{{$item->program_name}}">{{$item->program_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="modul">Modul</label>
                        <select name="modul" class="form-control" id="modul">
                            {{-- @foreach ($program as $item)
                            <option value="{{$item->program_name}}">{{$item->program_name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-primary btn-sm float-left"  
                data-toggle="modal" onclick="searchFunction();" >Search
            </button>
        </div>
    </div>

    <div>  
        <table id="myTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    {{-- 1 --}}
                    <th>User ID</th>
                    <th></th>     
                    {{-- 2 --}}
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>


    
    <!-- Modal -->
    <div class="modal fade" id="formData" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="addDataLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/addModel" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="id">
                        </div>
                        <div class="form-group">
                            <label for="nama">nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnsubmit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script> 
        $(document).ready(function() {
            // awal();
            dropDown('program', 'skill', '/skill/', 'skill_name', 'skill_name');
            dropDownModul('skill', 'modul', '/modul/', 'modul_name', 'modul_name');
 
        });


   //Divisi sebagai parent. departemen sebagai child 
   async function dropDown(divisi, child, url, kode, nama) {
            $('select[name="' + divisi + '"]').on('change', function() {
                // var filter = $("#program option:selected" ).text();//$(this).val();
                var filter = $(this).val();
                // alert($("#tahun").val());
                if (filter) {
                    $('select[name="' + child + '"]').empty();
                    $('select[name="' + "modul" + '"]').empty();
                    $('select[name="' + "skill" + '"]').append('<option value="' +
                                    "" + '">' + "--Skill Name--" + '</option>');
                    $.ajax({
                        url: url + filter+"/"+$("#tahun").val(),
                        type: "GET",
                        async: false,
                        dataType: "json",
                        success: function(data) {
                            // $('select[name="' + child + '"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="' + child + '"]').append('<option value="' +
                                    value[kode] + '">' + value[nama] + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="' + 'departemen' + '"]').empty();
                }
            });
        }

        async function dropDownModul(divisi, child, url, kode, nama) {
            $('select[name="' + divisi + '"]').on('change', function() {
                // var filter = $("#program option:selected" ).text();//$(this).val();
                var filter = $(this).val();
                if (filter) {
                    $('select[name="' + child + '"]').empty();
                    $('select[name="' + "modul" + '"]').append('<option value="' +
                                    "" + '">' + "--Modul Name--" + '</option>');
                    $.ajax({
                        url: url+$("#program").val()+"/"+ filter,
                        type: "GET",
                        async: false,
                        dataType: "json",
                        success: function(data) {
                            // $('select[name="' + child + '"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="' + child + '"]').append('<option value="' +
                                    value[kode] + '">' + value[nama] + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="' + 'departemen' + '"]').empty();
                }
            });
        }



        function searchFunction() {
            // alert($("#program option:selected" ).text());
            alert($("#program").val()+"|"+$("#skill").val()+"|"+$("#modul").val());
        }

        function awal() {
            $('#myTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/allModel',
                columns: [
                    // { data: '', name: '' },           
                    // {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        }

        function addFunction() {
            $('#id').attr('readonly', true);          
            $('#kode').attr('readonly', false);

            $('#kode').val('');
            $('#nama').val('');
            $('#formData').modal('show'); 
            readonly(false)      ; 
        }

        async function viewFunction($id) {
            readonly(true)      ;  
            $.ajax({
               type:'GET',
               async: false,
               url:'/Model/'+$id, //    data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                $("#id").val(data.id);                

                $('#id').attr('readonly', true);          
                $('#').attr('readonly', true);                
                $('#btnsubmit').prop("disabled",true);   
                $('#btnsubmit').prop("disabled",true); 
               }
            });    
            $('#formData').modal('show');   
        }

        async function editFunction($id) {    
            await viewFunction($id);
            $('#id').attr('readonly', true);        
            $('#btnsubmit').prop("disabled",false); 
            readonly(false)      ; 
            readonly(false)      ; 
        }


    function readonly(params) {
        $('#id').attr('readonly', params); 
        $('#userid').attr('readonly', params);  
        $('#name').attr('readonly', params); 
        
    }


    </script>
@stop