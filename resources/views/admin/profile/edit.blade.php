@extends('admin.common.layout')

@section('content')
<!-- Main content -->
<section class="content">

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Update Profile</h3>
        </div>
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        @if(Session::has('success'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
        @endif


        @if(Session::has('errors'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('errors') }}</p>
        @endif
        <!-- form start -->
        <form action="{{route('admin.profile.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="treasure_money">UserName</label>
                            <input type="text" name="name" value="{{old('name',$user->name)}}" class="form-control" placeholder="Enter UserName">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="money_left">Confirm Password</label>
                            <input type="password" name="confirm_password" value="{{old('confirm_password')}}" class="form-control" placeholder="Enter Confirm Password">
                        </div>

                        <div class="form-group">
                            <label for="start_time">Email</label>
                            <div class="input-group">
                                <input type="text" name="email" value="{{old('email',$user->email)}}" class="form-control float-right" id="" placeholder="Enter Email">
                            </div>
                            <!-- /.input group -->
                        </div>


                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Image</label>
                            <div class="col-sm-12 mb-2">
                                <input type="file" name="profile_image" id="image1">
                            </div>
                            <div class="col-sm-12">
                                <img src="{{ url("uploads/images/".$user->profile_photo)}}" id="image1_preview" height="150" width="150">
                            </div>
                            (.jpg,.png,.gif,.jpeg are allowed)
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Save</button>
                    <a class="btn btn-default" href="{{ url('admin/dashboard') }}"> Back</a>
                    <div class="col-4">

                    </div>
                </div>
            </div>
    </div>


    </form>
    </div>

</section>
@endsection
@section('page_specific_js')
<script type="text/javascript" src="{{asset('admin/js/common.js')}}"></script>
@endsection
