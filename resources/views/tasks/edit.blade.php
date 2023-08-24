@extends('tasks.layouts.master')
@push('styles')
    <style>
        .error-message{
            color: red;
            visibility: hidden;
        }
        .error-message.active{
            visibility: visible;
        }
    </style>
@endpush
@section('content')

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><b>Update Task </b></h1>
                            </div>
                <form method="POST" action="{{route('tasks.update', $task->id)}}">
                    @csrf
                    @method('PATCH')
                    @if(session()->has('alert'))
                        <div class="success-msg alert" id="success-msg">
                            {!! session('message')!!}
                        </div>
                    @endif
                    <div class="custom-row web-justify-space-between web-align-center web-mt-30">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="title"  id="title" value="{{$task->title}}"
                                       placeholder="Title">
                            </div>
                            @error('title')
                            <span class="error-message active">{{$message}}</span>
                            @enderror

                        </div>
                        <label>
                            Status:

                            <input type="checkbox" name="status" id="checkbox" value="1"
                                {{  ($task->status == 1 ? ' checked' : '') }}>
                        </label>

                        <div class="">

                            <div class="form-group row">
                                <label><strong>Description</strong></label>
                                <div class="col-sm-12 mb-3 mb-sm-0">

                                    <textarea name="description" id="description" class="form-control form-control-user">{{$task->description}}</textarea>



                                </div>
                                @error('description')
                                <span class="error-message active">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <hr>



                             <div class="custom-col-100 web-flex web-justify-center">
                            <div class="form-button web-mt-20 web-mb-40">
                                <input type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Update Task">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>



@endsection
@push('scripts')
    <script type="text/javascript">
        $('#checkbox').on('change', function () {
            this.value = this.checked ? 1 : 0;
            // alert(this.value);
        }).change();

    </script>
@endpush


