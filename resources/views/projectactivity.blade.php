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
                <th> kd_activity</th>
                <th> nm_activity</th>
                <th> desc_activity</th>
                <th> status</th>
                <th> kd_project</th>
                <th> jenis</th>
                <th> nm_project</th>
                <th> descripsi</th>
                <th> divisi</th>
                <th> departement</th>
                <th> file1</th>
                <th> file1_desc</th>
                <th> file2</th>
                <th> file2_desc</th>
                <th> file3</th>
                <th> file3_desc</th>
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
                    <form action="/addProjectActivity" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="id">id</label>
                            <input type="text" name="id" class="form-control" id="id">
                        </div>
                        <div class="form-group">
                            <label for="kd_activity">kd_activity</label>
                            <input type="text" name="kd_activity" class="form-control" id="kd_activity">
                        </div>
                        <div class="form-group">
                            <label for="nm_activity">nm_activity</label>
                            <input type="text" name="nm_activity" class="form-control" id="nm_activity">
                        </div>
                        <div class="form-group">
                            <label for="desc_activity">desc_activity</label>
                            <input type="text" name="desc_activity" class="form-control" id="desc_activity">
                        </div>
                        <div class="form-group">
                            <label for="status">status</label>
                            <input type="text" name="status" class="form-control" id="status">
                        </div>
                        <div class="form-group">
                            <label for="kd_project">kd_project</label>
                            <input type="text" name="kd_project" class="form-control" id="kd_project">
                        </div>
                        <div class="form-group">
                            <label for="jenis">jenis</label>
                            <input type="text" name="jenis" class="form-control" id="jenis">
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
                            <input type="text" name="divisi" class="form-control" id="divisi">
                        </div>
                        <div class="form-group">
                            <label for="departement">departement</label>
                            <input type="text" name="departement" class="form-control" id="departement">
                        </div>
                        <div class="form-group">
                            <label for="file1">file1</label>
                            <input type="text" name="file1" class="form-control" id="file1">
                        </div>
                        <div class="form-group">
                            <label for="file1_desc">file1_desc</label>
                            <input type="text" name="file1_desc" class="form-control" id="file1_desc">
                        </div>
                        <div class="form-group">
                            <label for="file2">file2</label>
                            <input type="text" name="file2" class="form-control" id="file2">
                        </div>
                        <div class="form-group">
                            <label for="file2_desc">file2_desc</label>
                            <input type="text" name="file2_desc" class="form-control" id="file2_desc">
                        </div>
                        <div class="form-group">
                            <label for="file3">file3</label>
                            <input type="text" name="file3" class="form-control" id="file3">
                        </div>
                        <div class="form-group">
                            <label for="file3_desc">file3_desc</label>
                            <input type="text" name="file3_desc" class="form-control" id="file3_desc">
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
                ajax: '/allProjectActivity',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'kd_activity',
                        name: 'kd_activity'
                    },
                    {
                        data: 'nm_activity',
                        name: 'nm_activity'
                    },
                    {
                        data: 'desc_activity',
                        name: 'desc_activity'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'kd_project',
                        name: 'kd_project'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
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
                        data: 'divisi',
                        name: 'divisi'
                    },
                    {
                        data: 'departement',
                        name: 'departement'
                    },
                    {
                        data: 'file1',
                        name: 'file1'
                    },
                    {
                        data: 'file1_desc',
                        name: 'file1_desc'
                    },
                    {
                        data: 'file2',
                        name: 'file2'
                    },
                    {
                        data: 'file2_desc',
                        name: 'file2_desc'
                    },
                    {
                        data: 'file3',
                        name: 'file3'
                    },
                    {
                        data: 'file3_desc',
                        name: 'file3_desc'
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
            $('#kd_activity').attr('readonly', true);
            $('#nm_activity').attr('readonly', true);
            $('#desc_activity').attr('readonly', true);
            $('#status').attr('readonly', true);
            $('#kd_project').attr('readonly', true);
            $('#jenis').attr('readonly', true);
            $('#nm_project').attr('readonly', true);
            $('#descripsi').attr('readonly', true);
            $('#divisi').attr('readonly', true);
            $('#departement').attr('readonly', true);
            $('#file1').attr('readonly', true);
            $('#file1_desc').attr('readonly', true);
            $('#file2').attr('readonly', true);
            $('#file2_desc').attr('readonly', true);
            $('#file3').attr('readonly', true);
            $('#file3_desc').attr('readonly', true);
            $('#id').val('');
            $('#kd_activity').val('');
            $('#nm_activity').val('');
            $('#desc_activity').val('');
            $('#status').val('');
            $('#kd_project').val('');
            $('#jenis').val('');
            $('#nm_project').val('');
            $('#descripsi').val('');
            $('#divisi').val('');
            $('#departement').val('');
            $('#file1').val('');
            $('#file1_desc').val('');
            $('#file2').val('');
            $('#file2_desc').val('');
            $('#file3').val('');
            $('#file3_desc').val('');
            $('#formData').modal('show');
            readonly(false);
        }
        async function viewFunction($id) {
            readonly(true);
            $.ajax({
                type: 'GET',
                async: false,
                url: '/getProjectActivityById/' + $id,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#kd_activity').val(data.kd_activity);
                    $('#nm_activity').val(data.nm_activity);
                    $('#desc_activity').val(data.desc_activity);
                    $('#status').val(data.status);
                    $('#kd_project').val(data.kd_project);
                    $('#jenis').val(data.jenis);
                    $('#nm_project').val(data.nm_project);
                    $('#descripsi').val(data.descripsi);
                    $('#divisi').val(data.divisi);
                    $('#departement').val(data.departement);
                    $('#file1').val(data.file1);
                    $('#file1_desc').val(data.file1_desc);
                    $('#file2').val(data.file2);
                    $('#file2_desc').val(data.file2_desc);
                    $('#file3').val(data.file3);
                    $('#file3_desc').val(data.file3_desc);
                    $('#btnsubmit').prop("disabled", true);

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
            $('#kd_activity').attr('readonly', params);
            $('#nm_activity').attr('readonly', params);
            $('#desc_activity').attr('readonly', params);
            $('#status').attr('readonly', params);
            $('#kd_project').attr('readonly', params);
            $('#jenis').attr('readonly', params);
            $('#nm_project').attr('readonly', params);
            $('#descripsi').attr('readonly', params);
            $('#divisi').attr('readonly', params);
            $('#departement').attr('readonly', params);
            $('#file1').attr('readonly', params);
            $('#file1_desc').attr('readonly', params);
            $('#file2').attr('readonly', params);
            $('#file2_desc').attr('readonly', params);
            $('#file3').attr('readonly', params);
            $('#file3_desc').attr('readonly', params);
        }

    </script>

@stop
