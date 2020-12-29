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
                <tr>
                    <th>User ID</th>
                    <th>Nama</th>
                    <th>E-mail</th>
                    <th>Nama Divisi</th>
                    <th>Nama Departemen</th>
                    {{-- <th>Role</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="formData" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addDataLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/addUser" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="id">
                        </div>

                        <div class="form-group">
                            <label for="userid">User Id</label>
                            <input type="text" name="userid" class="form-control" id="userid" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="bank">Bank</label>
                            {{-- <input type="text" name="bank" class="form-control"
                                id="bank"> --}}
                            <select name="bank" class="form-control" id="bank">
                                <option value="">BANK</option>
                                <option value="BNI">BNI</option>
                                <option value="BRI">BRI</option>
                                <option value="MAN">MANDIRI</option>
                                <option value="BCA">BCA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="norek">norek</label>
                            <input type="text" name="norek" class="form-control" id="norek">
                        </div>

                        <div class="form-group">
                            <label for="Divisi">Divisi</label>
                            <select name="divisi_kode" class="form-control" id="divisi_kode">
                                <option value="">Divisi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="departemen">Departemen</label>
                            <select name="departemen" class="form-control" id="departemen">
                                <option value="">Departement</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnsubmit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="test();" id="clik" class="btn btn-primary">click</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





@stop

@section('css')
    {{--
    <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/allUser',
                columns: [{
                        data: 'user_id',
                        name: 'userid'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'nama_divisi',
                        name: 'nama_divisi'
                    },
                    {
                        data: 'nama_departemen',
                        name: 'nama_departemen'
                    },
                    // { data: 'role', name: 'role' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            createSelect('divisi_kode', 'kode', 'nama', '/getAllDivisi');
            dropDown('divisi_kode', 'departemen', '/getDepartementByDivisi/', 'kode', 'nama');
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


        function addFunction() {
            $('#formData').modal('show');
            $("#id").val("");
            $("#userid").val("");
            $("#name").val("");
            $("#email").val("");
            $("#divisi_kode").val("");
            $("#bank").val("");
            $("#norek").val("");
            $("#divisi").val("");
            $("#departemen").val("");
            readonly(false);

            $('#userid').attr('readonly', false);
            //  dropDown('divisi_kode','departement','/getDepartementByDivisi/','kode','nama');
        }


        async function viewFunction($id) {
            createSelect('divisi_kode', 'kode', 'nama', '/getAllDivisi');
            $.ajax({
                type: 'GET',
                async: false,
                url: '/getUserById/' + $id,
                success: function(data) {
                    $("#id").val(data.id);
                    $("#userid").val(data.user_id);
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#divisi_kode").val(data.divisi);
                    $("#bank").val(data.bank);
                    $("#norek").val(data.norek);
                    // Departemen
                    var divisi_kode = data.divisi;
                    var dept = data.departemen;

                    createSelect('departemen', 'kode', 'nama', "/getDepartementByDivisi/" + divisi_kode);
                    $("#departemen").val(data.departemen);

                    readonly(true);
                }
            });
            $('#formData').modal('show');
        }

        async function editFunction($id) {
            await viewFunction($id);

            readonly(false);
        }

        function readonly(params) {
            $('#id').attr('readonly', true);
            $('#userid').attr('readonly', true);
            $('#name').attr('readonly', params);
            $('#email').attr('readonly', params);
            $('#divisi_kode').attr('readonly', params);
            $('#departemen').attr('readonly', params);
            $('#divisi_kode').attr('readonly', params);
            $('#bank').attr('readonly', params);
            $('#norek').attr('readonly', params);
            $('#btnsubmit').prop("disabled", params);
        }

        function test(params) {
            alert($("#departemen").val());
        }
        async function select(child, address, key, val, filter) {
            // // $('select[name="'+child+'"]').empty();
            // $.ajax({
            //             url: address,
            //             type: "GET",
            //             async: false,
            //             dataType: "json",
            //             success:function(data) {
            //                 $('select[name="'+child+'"]').empty();
            //                 $.each(data, function(key, value) {
            //                     //untuk edit/view atau add
            //                     // if(divisi_kode== value.kode ){
            //                         // $('select[name="departement"]').append('<option value="'+ value.kode +'" selected="true">'+ value.nama +'</option>');
            //                     // }else{
            //                         $('select[name="'+child+'"]').append('<option value="'+ 
            //                         value[key] +'">'+value[val]+'</option>');
            //                     // }
            //                 });
            //             }
            //         });

        }

    </script>
@stop
