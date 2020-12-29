@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Judul</h1>
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

@section('content')
    <div>
        @if (session('sukses'))
            <div class="alert alert-primary" role="alert">
                {{ session('sukses') }}
            </div>
        @endif
    </div>

    <div class="row text-nowrap">
        <div class="col-12" style="padding-top: 5px;">
            <button type="button" class="btn btn-primary btn-sm float-left" data-toggle="modal" onclick="addFunction();">Add
            </button>
        </div>
    </div>

    <div>
        <table id="myTable" class="display nowrap" style="width:100%">
            <thead>
                <th> id</th>
                <th> kd_project</th>
                <th> nm_project</th>
                <th> descripsi</th>
                <th> divisi</th>
                <th> departement</th>
                <th> jenis</th>
                <th>Action</th>
        </table>
    </div>
    <div class="modal fade" id="formData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addDataLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/addProject" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="id">id</label>
                            <input type="text" name="id" class="form-control" id="id">
                        </div>
                        <div class="form-group">
                            <label for="kd_project">kd_project</label>
                            <input type="text" name="kd_project" class="form-control" id="kd_project">
                        </div>
                        <div class="form-group">
                            <label for="nm_project">nm_project</label>
                            <input type="text" name="nm_project" class="form-control" id="nm_project">
                        </div>
                        <div class="form-group">
                            <label for="descripsi">descripsi</label>
                            <input type="text" name="descripsi" class="form-control" id="descripsi">
                        </div>
                        <div class="form-group">
                            <label for="divisi">divisi</label>
                            {{-- <input type="text" name="divisi" class="form-control" id="divisi"> --}}
                            <select name="divisi" class="form-control" id="divisi">
                                <option value="">Divisi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="departement">departement</label>
                            {{-- <input type="text" name="departement" class="form-control" id="departement"> --}}
                            <select name="departement" class="form-control" id="departement">
                                <option value="">Departement</option>
                                <option value='Supporing'>Supporing</option>
                                <option value='JOS'>JOS</option>
                                <option value='Syariah'>Syariah</option>
                                <option value='Digital'>Digital</option>
                                <option value='Gadai'>Gadai</option>
                                <option value='Leadership'>Leadership</option>
                                <option value='Micro'>Micro</option>
                                <option value='LOGS'>LOGS</option>
                                <option value='Sertifikasi'>Sertifikasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis">jenis</label>
                            {{-- <input type="text" name="jenis" class="form-control" id="jenis"> --}}
                            <select name="jenis" class="form-control" id="jenis">
                                <option value="">Jenis Project</option>
                                <option value='Training'>Training</option>
                                <option value='Pengadaan'>Pengadaan</option>
                                <option value='Data'>Data</option>
                                <option value='Lain'>Lain-lain</option>
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
    <link rel="stylesheet" href="/css/app.css">
@stop
@section('js')
    <script>
        $(document).ready(function() {
            createSelect('divisi', 'kode', 'nama', '/getAllDivisi');
            dropDown('divisi', 'departement', '/getDepartementByDivisi/', 'kode', 'nama');
            awal();

        });
        //memebuat combobox/selection, params=nama object select,kode = kode/key dari combo/select , nama=text dari select/combo
        function createSelect(params, kode, nama, url) {
            $('select[name="' + params + '"]').empty();
            $.ajax({
                url: url,
                type: "GET",
                async: false,
                dataType: "json",
                success: function(data) {
                    $('select[name="' + params + '"]').empty();
                    $('select[name="' + params + '"]').append('<option value="' +
                        '">' + 'Divisi' + '</option>');
                    $.each(data, function(key, value) {
                        $('select[name="' + params + '"]').append('<option value="' +
                            value[kode] + '">' + value[nama] + '</option>');
                    });
                }
            });
        }


         //Divisi sebagai parent. departemen sebagai child 
         async function dropDown(divisi, child, url, kode, nama) {
            $('select[name="' + divisi + '"]').on('change', function() {
                var filter = $(this).val();
                if (filter) {
                    $('select[name="' + child + '"]').empty();
                    $.ajax({
                        url: url + filter,
                        type: "GET",
                        async: false,
                        dataType: "json",
                        success: function(data) {
                            $('select[name="' + child + '"]').empty();
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

        function awal() {
            $('#myTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/allProject',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'kd_project',
                        name: 'kd_project'
                    },
                    {
                        data: 'nm_project',
                        name: 'nm_project'
                    },
                    {
                        data: 'descripsi',
                        name: 'descripsi'
                    },
                    {
                        data: 'nm_divisi',
                        name: 'nm_divisi'
                    },
                    {
                        data: 'nm_departement',
                        name: 'nm_departement'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        }

        function addFunction() {
            $('#id').attr('readonly', true);
            $('#kd_project').attr('readonly', true);
            $('#nm_project').attr('readonly', true);
            $('#descripsi').attr('readonly', true);
            $('#divisi').attr('readonly', true);
            $('#departement').attr('readonly', true);
            $('#jenis').attr('readonly', true);
            $('#id').val('');
            $('#kd_project').val('');
            $('#nm_project').val('');
            $('#descripsi').val('');
            $('#divisi').val('');
            $('#departement').val('');
            $('#jenis').val('');
            $('#formData').modal('show');
            readonly(false);
        }
        async function viewFunction($id) {
            readonly(true);
            $.ajax({
                type: 'GET',
                async: false,
                url: '/getProjectById/' + $id,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#kd_project').val(data.kd_project);
                    $('#nm_project').val(data.nm_project);
                    $('#descripsi').val(data.descripsi);
                    $('#divisi').val(data.divisi);
                    $('#jenis').val(data.jenis);
                    $('#btnsubmit').prop("disabled", true);
                    // Departemen
                    var divisi_kode = data.divisi;
                    var dept = data.departement;
                    createSelect('departement', 'kode', 'nama', "/getDepartementByDivisi/" + divisi_kode);
                    $('#departement').val(data.departement);


                }

            });

            $('#formData').modal('show');
        }

        async function editFunction($id) {
            await viewFunction($id);
            $('#id').attr('readonly', true);
            $('#btnsubmit').prop("disabled", false);
            readonly(false);
        }

        function readonly(params) {
            $('#id').attr('readonly', params);
            $('#kd_project').attr('readonly', params);
            $('#nm_project').attr('readonly', params);
            $('#descripsi').attr('readonly', params);
            $('#divisi').attr('readonly', params);
            $('#departement').attr('readonly', params);
            $('#jenis').attr('readonly', params);
        }

    </script>

@stop
