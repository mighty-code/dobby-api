@extends('layouts.app')

@section('content')

    @include('includes.btn-home')

    <div class="container flex-center">
        <i class="fa fa-train fa-5x mb-5"></i>
        <h1 class="text-center">Manage your connections</h1>
        <div class="row mt-4" style="min-width: 300px">
            <div class="col-12">
                <create-connection submit-text="Done"></create-connection>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <list-connections class="mt-10"></list-connections>
            </div>
        </div>
    </div>

@endsection