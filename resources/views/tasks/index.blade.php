@extends('tasks.layouts.master')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        @if(session()->has('message'))
            <div class="success-msg active" id="success-msg">
                {!! session('message')!!}
            </div>
        @endif
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tasks</h6>
            <a href="{{url('tasks/create')}}" class="btn btn-success btn-icon-split align-content-lg-end">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus-circle"></i>
                                        </span>
                <span class="text">Tasks</span>
            </a>

        </div>
{{--            <div class="card-header py-3 text-capitalize text-right">--}}
{{--            <button type="button" class="btn btn-warning position-relative">--}}
{{--                Total Users--}}
{{--                <span class="top-300 start-200 translate-middle badge rounded-pill bg-danger">--}}
{{--    {{$users->count()}}+--}}
{{--    <span class="visually-hidden">Users</span>--}}
{{--  </span>--}}
{{--            </button>--}}
{{--                </div>--}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>

                        <th>Action</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($tasks as $key => $task)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$task->title}}</td>
                        <td>@if($task->status == 1)
                                <a href="{{url('tasks/status/0')}}/{{$task->id}}"><button type="buton" class="btn btn-primary">Completed</button></a>
                            @elseif($task->status == 0)
                                <a href="{{url('tasks/status/1')}}/{{$task->id}}"><button type="buton" class="btn btn-warning">Pending</button></a>
                            @endif</td>

                        <td colspan="3">  <a href="{{route('tasks.show',$task->id)}}" class="btn btn-success">Show</a>
                            <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('tasks.destroy',$task->id) }}" method="Post" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                        </td>

                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection

@push('scripts')


@endpush
