@extends('layouts.app')

@section('content')

    <div class="container h-full mx-auto">

        <div class="flex h-full flex-col items-center">
            <div class="flex justify-center">
                <x-goto-home/>
            </div>


            <div class="w-full md:w-1/2 lg:w-1/3 mt-10">
                <div class="flex justify-center py-4">
                    <x-icons.train class="text-white h-20"/>
                </div>
                <h1 class="text-center text-white text-2xl">Manage your connections</h1>
                <div class="row mt-4">
                    <div class="col-12">
                        <livewire:create-connection submit-text="Done"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <list-connections class="mt-10"></list-connections>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
