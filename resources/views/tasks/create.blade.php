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
                                <h1 class="h4 text-gray-900 mb-4"><b>Create Task</b></h1>
                            </div>
                            <form class="user" method="POST" action="{{route('tasks.store')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="title"
                                               id="title" value="{{old('title')}}"
                                               placeholder="Title">
                                    </div>
                                    @error('title')
                                    <span class="error-message active">{{$message}}</span>
                                    @enderror
                                </div>

                                <label>
                                    Status:
                                    <input type="checkbox" name="status" id="status" value="0">
                                </label>

                                <div class="">

                                    <div class="form-group row">
                                        <label><strong>Description</strong></label>
                                        <div class="col-sm-12 mb-3 mb-sm-0">

                                            <textarea name="description" id="description"
                                                      class="form-control form-control-user"></textarea>


                                        </div>
                                    </div>
                                    @error('description')
                                    <span class="error-message active">{{$message}}</span>
                                    @enderror
                                </div>
                                <hr>
                                <input type="submit" class="btn btn-primary btn-user btn-block" name="submit"
                                       value="Submit">


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
        $('#status').on('change', function () {
            this.value = this.checked ? 1 : 0;
            // alert(this.value);
        }).change();

    </script>




@endpush

