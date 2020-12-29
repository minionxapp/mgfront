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
                    <th>Nama</th>
                    <th>Nik</th>
                    <th>Nama Kepala</th>
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
                <h5 class="modal-title" id="staticBackdropLabel">Data Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="/addDivisi" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="id" class="form-control" id="id">
                        </div>

                        <div class="form-group">
                          <label for="kode">Kode</label>
                          <input type="text" name="kode" class="form-control" id="kode" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_kadiv">nik_kadiv</label>
                            <input type="text" name="nik_kadiv" class="form-control" id="nik_kadiv" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_kadiv">nama_kadiv</label>
                            <input type="text" name="nama_kadiv" class="form-control" id="nama_kadiv" required>
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
                ajax: '/allDivisi',       
                columns: [
                    { data: 'kode', name: 'kode' },
                    { data: 'nama', name: 'nama' },
                    { data: 'nik_kadiv', name: 'nik_kadiv' },
                    { data: 'nama_kadiv', name: 'nama_kadiv' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        }

        function addFunction() {
            // {{--  'kode', 'nama', 'nik_kadiv','nama_kadiv',     --}}
            $('#id').attr('readonly', true);          
            $('#kode').attr('readonly', false);
            $('#nama').attr('readonly', false);
            $('#nik_kadiv').attr('readonly', false);
            $('#nama_kadiv').attr('readonly', false);
            $('#formData').modal('show'); 

            $('#kode').val('');
            $('#nama').val('');
            $('#nik_kadiv').val('');
            $('#nama_kadiv').val('');
        }

        async function viewFunction($id) {
            $.ajax({
                    type:'GET',
                    async: false,
                    url:'/getDivisiById/'+$id, //    data:'_token = <?php echo csrf_token() ?>',
                    success:function(data) {
                        $("#id").val(data.id);
                        $("#kode").val(data.kode);
                        $("#nama").val(data.nama);
                        $("#nik_kadiv").val(data.nik_kadiv);
                        $("#nama_kadiv").val(data.nama_kadiv);
                        
                        $('#id').attr('readonly', true);          
                        $('#kode').attr('readonly', true);
                        $('#nama').attr('readonly', true);
                        $('#nik_kadiv').attr('readonly', true);
                        $('#nama_kadiv').attr('readonly', true);
                        $('#btnsubmit').prop("disabled",true);   
                        $('#btnsubmit').prop("disabled",true); 
                    }
            }   );    
            $('#formData').modal('show');    
        }

        async function editFunction($id) {    
            await viewFunction($id);
            $('#id').attr('readonly', true);          
            $('#kode').attr('readonly', true);
            $('#nama').attr('readonly', false);
            $('#nik_kadiv').attr('readonly', false);
            $('#nama_kadiv').attr('readonly', false);
            $('#btnsubmit').prop("disabled",false); 
        }
    </script>
@stop