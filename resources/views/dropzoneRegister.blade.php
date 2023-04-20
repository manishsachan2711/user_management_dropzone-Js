@extends('layouts.app')

@section('content')
<style>
    .dropzoneDragArea {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        text-align: center;
        cursor: pointer;
    }
    .dropzone{
        box-shadow: 0px 2px 20px 0px #f2f2f2;
        border-radius: 10px;
        min-height:10px
    }
    .error {
        color: red;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
					<form action="{{ route('form.data') }}" name="demoform" id="demoform" method="POST" class="dropzone" enctype="multipart/form-data">
                        @csrf
						<div class="form-group">
							<input type="hidden" class="userid" name="userid" id="userid" value="">
							<label for="name">Name</label>
							<input type="text" name="name" id="name" placeholder="Enter your name" class="form-control" autocomplete="off">
						    <span class="text-danger" id="errorName"></span>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <br>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" placeholder="Enter your email" class="form-control"  autocomplete="off">
                            <span class="text-danger" id="errorEmail"></span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                        </div>
                        <br>
						<div class="form-group">
                            <label for="name">Profile Photo</label>
                  			<div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea dropzone">
                  				{{--  //<span>Upload file</span>  --}}
                                  <div id="manish" class="dropzone-previews"></div>
                                  <span class="text-danger" id="imageError"></span>
                                  @error('prifile_photo')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                          @enderror
                  			</div>

                  		</div>
                          <div class="form-group">
                            <label for="password" >{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                <span class="text-danger" id="errorPassword"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password_confirm" >{{ __('Confirm Password') }}</label>
                                <input id="password_confirm" type="password" class="form-control" name="password_confirm"  autocomplete="new-password">
                                @error('password_confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                            </div>
                        <br>
                  		<div class="form-group">
	        				<button id="getSubmit" type="submit" class="btn btn-md btn-primary">Register</button>
	        			</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
    {{--  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>  --}}
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script>
    Dropzone.autoDiscover = false;

    let token = $('meta[name="csrf-token"]').attr('content');
    $(function() {
    var myDropzone = new Dropzone("div#dropzoneDragArea", {
        paramName: "file",
        url: "{{ url('/storeimgae') }}",
        previewsContainer: 'div.dropzone-previews',
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: false,
        parallelUploads: 1,
        maxFiles: 1,
        acceptedFiles:'image/*',
        dictRemoveFile: "Remove profile photo",
        params: {
            _token: token
        },
         // The setting up of the dropzone
        init: function() {
            $("#demoform").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,

                    },
                    password: {
                        required: true,

                    },
                    password_confirm: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: "Please enter name",
                    email: "Please enter email",
                    password: "Please enter password",
                    password_confirm:"Password do not match",
                }
            });


            var myDropzone = this;
            //form submission code goes here
            $("form[name='demoform']").submit(function(event) {
                //Make sure that the form isn't actully being sent.
                event.preventDefault();
                var flag =false;

                let parent = $("#manish").text();
                    if(parent ==""){
                    document.getElementById("imageError").innerHTML="Please upload an image";
                    setTimeout(function(){
                        document.getElementById("imageError").innerHTML = '';
                    }, 5000);
                    flag= false;
                    }
            if(parent != ""){
                flag = true;
            }
              if(flag){
                URL = $("#demoform").attr('action');
                formData = $('#demoform').serialize();
                $.ajax({
                    type: 'POST',
                    url: URL,
                    data: formData,
                    success: function(result){
                        if(result.status == "success"){
                            // fetch the useid
                            var userid = result.user_id;
                            $("#userid").val(userid); // inseting userid into hidden input field
                            //process the queue
                            myDropzone.processQueue();
                        }else{
                            console.log("error");
                        }
                    },
                    error:function(data){
                     // console.log(data);
                     if(data.responseJSON.errors.name){
                        // $('#errorName').css('display', 'block');
                         $('#errorName').text(data.responseJSON.errors.name);
                     }
                     if(data.responseJSON.errors.email){
                       //  $('#errorEmail').css('display', 'block');
                         $('#errorEmail').text(data.responseJSON.errors.email);
                     }
                     if(data.responseJSON.errors.password){
                        // $('#password').css('display', 'block');
                         $('#errorPassword').text(data.responseJSON.errors.password);
                     }
                    }
                });
            }else{
                return false;
            }
            });

            //Gets triggered when we submit the image.
            this.on('sending', function(file, xhr, formData){
            //fetch the user id from hidden input field and send that userid with our image
              let userid = document.getElementById('userid').value;
               formData.append('userid', userid);
            });

            this.on("success", function (file, response) {
                // redirect
                window.location.href = '/home';
            });
        }
        });
    });
    </script>
@endsection
