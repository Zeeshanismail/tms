@extends('tasks.layouts.master')
@section('content')
    <div class="container-fluid">


        <div class="container single-data-wrap mt-5 mb-5">
        <h2 class="h4 text-gray-900 mb-2 mt-3 text-center"><b>Tasks</b></h2>
        <div class="row h-100 align-items-center mt-5">
                <div class="col-xl-6 col-md-12 mb-3">
                    <div class="">
                        <h1 class="h4 text-gray-900 mb-2">  Title :
                        </h1>
                        <p class="mb-0">   {{$task->title}}</p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-3">
                    <div class="">
                        <h1 class="h4 text-gray-900 mb-2">   Description :
                        </h1>

                        <p class="mb-0">   {{$task->description}}</p>
                    </div>
                </div>




                <div class="col-xl-6 col-md-12 mb-3">
                    <div class="">
                        <h1 class="h4 text-gray-900 mb-2">    Status
                        </h1>

                        @if($task->status == 0)
                            <p class="mb-0">   Pending</p>
                        @else
                            <p class="mb-0">   Completed</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
