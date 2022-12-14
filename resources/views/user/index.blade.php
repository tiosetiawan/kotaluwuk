@extends('layouts.main_master')

@section('container')

<div class="container-fluid  pt-3 pb-2 mb-3">
    <div class="card">
        <div class="card-header">
            {!! $header !!}
        </div>
        <div class="card-body">
            <button id="add_btn" class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-plus"></i> Add</button><hr>
            <table class="table table-bordered" id="tableuser" style="width:100%">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
