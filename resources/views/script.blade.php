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
                    <th></th>
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
                    <form action="/addModel" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="id">
                        </div>
                        <div class="form-group">
                            <label for="table">Table</label>
                            <textarea id="table" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="scrip">Scrip</label>
                            <textarea id="scrip" class="form-control" rows="3" placeholder="..."></textarea>
                        </div>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm float-left" data-toggle="modal"
                                onclick="createScript();">Create View</button>
                            <button type="button" class="btn btn-primary btn-sm float-left" data-toggle="modal"
                                onclick="createController();">Create Controller</button>
                            <button type="button" class="btn btn-primary btn-sm float-left" data-toggle="modal"
                                onclick="createRoute();">Create Route</button>
                            {{--scriptRoute <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnsubmit" class="btn btn-primary">Submit</button> --}}
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
            
        function addFunction() {
            $('#formData').modal('show');
            $("#scrip").empty();
            $("#table").empty();
            $("#table").append('{ "table":"TestScrip","colum":[{"column":"id"},{"column":"kode"},{"column":"nama"}]}');
        }
        function createScript(params) {        
            table = $("#table").val();
            var obj = JSON.parse(table);
            createView(table)
        }
	
        function createView($id) {
           
            $.ajax({
                type: 'GET',
                async: false,
                url: '/scriptView/' + $id,
                success: function(data) {
                $("#scrip").empty();
                $("#scrip").append(data);
                }
            });
        }

        function createController() {        
            table = $("#table").val();
            var obj = JSON.parse(table);
            alert("createController "+table);
            $.ajax({
                type: 'GET',
                async: false,
                url: '/scriptController/'+table,
                success: function(data) {
                    alert(data);
                $("#scrip").empty();
                $("#scrip").append(data);
                }
            });
        }
    

        function createRoute(){
            table = $("#table").val();
            var obj = JSON.parse(table);
            alert("scriptRoute "+table);
            $.ajax({
                type: 'GET',
                async: false,
                url: '/scriptRoute/'+table,
                success: function(data) {
                    alert(data);
                $("#scrip").empty();
                $("#scrip").append(data);
                }
            });
        }
        // ;scriptRoute
            
    </script>
@stop
