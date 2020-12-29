@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Departement</li>
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
            <button type="button" class="btn btn-primary btn-sm float-left"  
                data-toggle="modal" onclick="addFunction();" >Add
            </button>
        </div>
    </div>

    <div>  
        <table id="myTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>                    
                    <th>Kode</th>
                    <th>Nama  Dept</th>  
                    <th>Nik Ka.Dept</th>                  
                    <th>Nama Ka.Dept</th> 
                    <th>Nama Divisi</th> 
                    <th>Kode Divisi</th> 
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
                <h5 class="modal-title" id="staticBackdropLabel">Data Departement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/addDepartement" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="id">
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode Dept</label>
                            <input type="text" name="kode" class="form-control" id="kode" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Dept</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_kadept">Nik Ka.Dept</label>
                            <input type="text" name="nik_kadept" class="form-control" id="nik_kadept" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_kadept">Nama Ka.Dept</label>
                            <input type="text" name="nama_kadept" class="form-control" id="nama_kadept" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="divisi_kode">Divisi</label>
                            <input type="text" name="divisi_kode" class="form-control" id="divisi_kode" required>
                        </div> --}}
                        
                        <div class="form-group">
                            <select name="divisi_kode" class="form-control" id="divisi_kode">
                                <option value="">Divisi</option>
                                @foreach ($divisi as $item)
                                    <option value={{$item->kode}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
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
                ajax: '/allDepartement',
                columns: [
                    { data: 'kode', name: 'kode' }, 
                    { data: 'nama', name: 'nama' }, 
                    { data: 'nik_kadept', name: 'nik_kadept' }, 
                    { data: 'nama_kadept', name: 'nama_kadept' }, 
                    { data: 'nama_divisi', name: 'nama_divisi' }, 
                    { data: 'divisi_kode', name: 'divisi_kode' }, 
                    
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        }

        function addFunction() {
            $('#id').attr('readonly', true);          
            $('#kode').attr('readonly', false);
            $('#nama').attr('readonly', false);
            $('#nik_kadept').attr('readonly', false);
            $('#nama_kadept').attr('readonly', false);
            $('#divisi_kode').attr('readonly', false);
            $('#formData').modal('show'); 

            $('#kode').val('');
            $('#nama').val('');
            $('#nik_kadept').val('');
            $('#nama_kadept').val('');
            $('#divisi_kode').val('');
        }

        async function viewFunction($id) {
            $.ajax({
               type:'GET',
               async: false,
               url:'/getDepartementById/'+$id, //    data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                $("#id").val(data.id);  
                $('#kode').val(data.kode);
                $('#nama').val(data.nama);
                $('#nik_kadept').val(data.nik_kadept);
                $('#nama_kadept').val(data.nama_kadept);
                $('#divisi_kode').val(data.divisi_kode);              

                $('#id').attr('readonly', true);          
                $('#kode').attr('readonly', true);
                $('#nama').attr('readonly', true);
                $('#nik_kadept').attr('readonly', true);
                $('#nama_kadept').attr('readonly', true);
                $('#divisi_kode').attr('readonly', true);              
                $('#btnsubmit').prop("disabled",true);   
               }
            });    
            $('#formData').modal('show');    
        }

        async function editFunction($id) {    
            await viewFunction($id);
            $('#id').attr('readonly', true);  
            $('#kode').attr('readonly', true);
            $('#nama').attr('readonly', false);
            $('#nik_kadept').attr('readonly', false);
            $('#nama_kadept').attr('readonly', false);
            $('#divisi_kode').attr('readonly', false);         
            $('#btnsubmit').prop("disabled",false); 
        }


    </script>
@stop