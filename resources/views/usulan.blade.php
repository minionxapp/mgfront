@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usulan</h1>
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
                    <th>No Surat</th>
                    <th>Deskripsi</th>
                    <th>Unit Kerja</th>
                    <th>Status</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    {{-- <th>file_usul</th>
                    <th>file_usul_link</th>
                    <th>file_dispo</th>
                    <th>file_dispo_link</th>
                    <th>comment</th>
                    <th>deadline</th>

                    <th>jenis_usul</th>
                    <th>pic_usul</th>
                    <th>no_pic_usul</th>
                    <th>asign_to</th>
                    <th>pic_asign_to</th>
                    <th>asign_desc</th>
                    <th>create_by</th>
                    <th>update_by</th> --}}
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
                    <h5 class="modal-title" id="staticBackdropLabel">Usulan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/addUsulan" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="id">
                        </div>

                        <div class="form-group">
                            <label for="no_srt">No Surat</label>
                            <input type="text" name="no_srt" class="form-control" id="no_srt">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi">
                        </div>
                        <div class="form-group">
                            <label for="unit_usul">Unit Kerja</label>
                            <input type="text" name="unit_usul" class="typeahead form-control" id="unit_usul">



                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="jenis_usul">Jenis Usulan</label>
                                {{-- <input type="text" name="jenis_usul" class="form-control"
                                    id="jenis_usul"> --}}
                                <select name="jenis_usul" class="form-control" id="jenis_usul">
                                    <option value="">Jenis Usulan</option>
                                    <option value='Training'>Training</option>
                                    <option value='Data'>Data</option>
                                    <option value='Lain'>Lain-lain</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="">Status</option>
                                    <option value='Usul'>Usulan</option>
                                    <option value='OnProgress'>OnProgress</option>
                                    <option value='Selesai'>Selesai</option>
                                    <option value='Tolak'>Tolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file_usul" id='lbl_file_usul'>File Usulan :</label>
                            <input type="file" name="file_usul" class="form-control" id="file_usul">
                        </div>
                        <div class="form-group">
                            <label for="lbl_file_dispo" id="lbl_file_dispo">File Disposisi</label>
                            <input type="file" name="file_dispo" class="form-control" id="file_dispo">
                        </div>

                        {{-- <div class="form-group">
                            <label for="file_dispo_link">file_dispo_link</label>
                            <input type="text" name="file_dispo_link" class="form-control" id="file_dispo_link">
                        </div> --}}
                        <div class="form-group">
                            <label for="comment">Catatan</label>
                            <input type="text" name="comment" class="form-control" id="comment">
                        </div>
                        {{-- <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="date" name="deadline" class="form-control" id="deadline">
                        </div> --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mulai">Mulai</label>
                                <input type="date" name="mulai" class="form-control" id="mulai">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="selesai">Selesai</label>
                                <input type="date" name="selesai" class="form-control" id="selesai">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="pic_usul">P I C</label>
                            <input type="text" name="pic_usul" class="form-control" id="pic_usul">
                        </div>
                        <div class="form-group">
                            <label for="no_pic_usul">PIC Contact</label>
                            <input type="text" name="no_pic_usul" class="form-control" id="no_pic_usul">
                        </div>
                        <div class="form-group">
                            <label for="asign_to">Assign Ke</label>
                            {{-- <input type="text" name="asign_to" class="form-control" id="asign_to"> --}}
                            <select name="asign_to" class="form-control" id="asign_to">
                                <option value="">Assign Ke</option>
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
                            <label for="pic_asign_to">PIC Assign</label>
                            <input type="text" name="pic_asign_to" class="form-control" id="pic_asign_to">
                        </div>
                        <div class="form-group">
                            <label for="asign_desc">Asign Desc</label>
                            <input type="text" name="asign_desc" class="form-control" id="asign_desc">
                        </div>

                        {{-- <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="" class="form-control" id="">
                        </div> --}}





                        {{-- <div class="form-group">
                            <select name="role" class="form-control" id="role">
                                <option value="">Role</option>
                                @foreach ($roles as $role)
                                    <option value={{ $role->role_id }}>{{ $role->desc }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnsubmit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        
</script>
@stop

@section('css')
    {{--
    <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
@stop
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    
    @section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>
        $(document).ready(function() {
            awal();

            var path = "{{ route('autocomplete') }}";
                $('input.typeahead').typeahead({
                    source:  function (query, process) {
                    return $.get(path, { query: query }, function (data) {
                        // alert(data);
                            return process(data);
                        });
                    }
                });


        });

        function awal() {
            $('#myTable').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/allUsulan',
                columns: [{
                        data: 'no_srt',
                        name: 'no_srt'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'unit_usul',
                        name: 'unit_usul'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'mulai',
                        name: 'mulai'
                    },
                    {
                        data: 'selesai',
                        name: 'selesai'
                    },

                    // { data: 'file_usul', name: 'file_usul' }, 
                    // { data: 'file_usul_link', name: 'file_usul_link' }, 
                    // { data: 'file_dispo', name: 'file_dispo' }, 
                    // { data: 'file_dispo_link', name: 'file_dispo_link' }, 
                    // { data: 'comment', name: 'comment' }, 
                    // { data: 'deadline', name: 'deadline' }, 
                    // { data: 'jenis_usul', name: 'jenis_usul' }, 
                    // { data: 'pic_usul', name: 'pic_usul' }, 
                    // { data: 'no_pic_usul', name: 'no_pic_usul' }, 
                    // { data: 'asign_to', name: 'asign_to' }, 
                    // { data: 'pic_asign_to', name: 'pic_asign_to' }, 
                    // { data: 'asign_desc', name: 'asign_desc' }, 
                    // { data: 'create_by', name: 'create_by' }, 
                    // { data: 'update_by', name: 'update_by' }, 

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
            $('#kode').val('');
            $('#nama').val('');
            $('#no_srt').val('');
            $('#deskripsi').val('');
            $('#unit_usul').val('');
            $('#status').val('');
            $('#file_usul').val('');
            $('#file_usul_link').val('');
            $('#file_dispo').val('');
            $('#file_dispo_link').val('');
            $('#comment').val('');
            $('#deadline').val('');
            $('#jenis_usul').val('');
            $('#pic_usul').val('');
            $('#no_pic_usul').val('');
            $('#asign_to').val('');
            $('#pic_asign_to').val('');
            $('#asign_desc').val('');
            $('#create_by').val('');
            $('#update_by').val('');
            $('#mulai').val('');
            $('#selesai').val('');

            readonly(false);
            $('#formData').modal('show');
            $("#lbl_file_dispo").empty();
            $("#lbl_file_dispo").append('  File Disposisi :');
            $("#lbl_file_usul").empty();
            $("#lbl_file_usul").append('  File Usulan :');
        }

        async function viewFunction($id) {
            readonly(true);
            $.ajax({
                type: 'GET',
                async: false,
                url: '/getUsulanById/' +
                    $id, //    data:'_token = <?php echo csrf_token(); ?>',
                success: function(data) {
                    $("#id").val(data.id);
                    $('#no_srt').val(data.no_srt);
                    $('#deskripsi').val(data.deskripsi);
                    $('#unit_usul').val(data.unit_usul);
                    $('#status').val(data.status).change();
                    $('#file_usul_link').val(data.file_usul_link);
                    $('#file_dispo_link').val(data.file_dispo_link);
                    $('#comment').val(data.comment);
                    $('#deadline').val(data.deadline);
                    $('#jenis_usul').val(data.jenis_usul);
                    $('#pic_usul').val(data.pic_usul);
                    $('#no_pic_usul').val(data.no_pic_usul);
                    $('#asign_to').val(data.asign_to);
                    $('#pic_asign_to').val(data.pic_asign_to);
                    $('#asign_desc').val(data.asign_desc);
                    $('#create_by').val(data.create_by);
                    $('#update_by').val(data.update_by);
                    $('#mulai').val(data.mulai);
                    $('#selesai').val(data.selesai);
                    if (data.file_usul != null) {
                        $("#lbl_file_usul").empty();
                        $("#lbl_file_usul").append('  File Usulan :  <a href="{{ config('constant.imageShow') }}' +
                         data.file_usul +'" target=\"_blank\"">' +
                         data.file_usul.substring(11) + '</a>');
                    }
                    if (data.file_dispo != null) {
                        $("#lbl_file_dispo").empty();
                        $("#lbl_file_dispo").append('  File Disposisi :  <a href="{{ config('constant.imageShow') }}' +
                         data.file_dispo + '" target=\"_blank\"">' + 
                         data.file_dispo.substring(11) + '</a>');
                    }

                    $('#id').attr('readonly', true);

                    $('#btnsubmit').prop("disabled", true);
                    $('#btnsubmit').prop("disabled", true);
                }
            });
            $('#formData').modal('show');
        }

        async function editFunction($id) {
            await viewFunction($id);
            readonly(false);
            $('#btnsubmit').prop("disabled", false);
        }


        // 'no_srt','deskripsi','unit_usul','status','file_usul','file_usul_link','file_dispo','file_dispo_link','comment','deadline','jenis_usul','pic_usul','no_pic_usul','asign_to','pic_asign_to','asign_desc','create_by','update_by',   
        function readonly(params) {
            $('#id').attr('readonly', true);
            $('#no_srt').attr('readonly', params);
            $('#deskripsi').attr('readonly', params);
            $('#unit_usul').attr('readonly', params);
            $('#status').attr('readonly', params);
            $('#file_usul').attr('readonly', params);
            $('#file_usul_link').attr('readonly', params);
            $('#file_dispo').attr('readonly', params);
            $('#file_dispo_link').attr('readonly', params);
            $('#comment').attr('readonly', params);
            $('#deadline').attr('readonly', params);
            $('#jenis_usul').attr('readonly', params);
            $('#pic_usul').attr('readonly', params);
            $('#no_pic_usul').attr('readonly', params);
            $('#asign_to').attr('readonly', params);
            $('#pic_asign_to').attr('readonly', params);
            $('#asign_desc').attr('readonly', params);
            $('#create_by').attr('readonly', params);
            $('#update_by').attr('readonly', params);

            $('#mulai').attr('readonly', params);
            $('#selesai').attr('readonly', params);

            $('#userid').attr('readonly', params);
            $('#name').attr('readonly', params);

        }

    </script>
@stop
