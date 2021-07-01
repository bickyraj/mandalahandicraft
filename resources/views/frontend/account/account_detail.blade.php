@extends('frontend.account.layout')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
@section('body')
 <div class="col-md-9 aside">
                        <h2>Account Details</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Personal Info</h3>
                                        <p><b>Full Name:</b> {{$user->name}}<br>
                                           <b>E-mail:</b> {{$user->email}}<br>
                                           <b>Phone:</b> {{$user->phone}}<br/>
                                           <b>Address:</b> {{$user->address}}<br/>
                                       </p>
                                        <div class="mt-2 clearfix"><a href="#" class="link-icn js-show-form edit_detail" ><i class="icon-pencil"></i>Edit</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3" id="updateDetails" style="display: none">
                            <div class="card-body">
                                <h3>Update Account Details</h3>
                                <form action="{{route('account.update')}}" method="post" id="profile_form"  data-toggle="validator">
                                <div class="row mt-2">
                                    <div class="col-sm-6">
                                        <label class="text-uppercase">Full Name:</label>
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control" placeholder="Enter Name" data-error="Fullname is required" required value="{{auth()->user()->name}}">
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="text-uppercase">E-mail:</label>
                                        <div class="form-group">
                                            <input type="email"  class="form-control" placeholder="jennyraider@hotmail.com" disabled value="{{auth()->user()->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    
                                    <div class="col-sm-6">
                                        <label class="text-uppercase">Phone Number:</label>
                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control" placeholder="Enter Number" required data-error="Contact number is required" value="{{auth()->user()->phone}}">
                                             <span class="help-block with-errors"></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="text-uppercase">Address:</label>
                                        <div class="form-group">
                                            <input type="text" name="address" class="form-control" placeholder="Enter Address" required data-error="Address is required" value="{{auth()->user()->address}}">
                                             <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                   
                                    <button type="submit" class="btn ml-1"><i class="fa fa-spinner fa-spin loading-image" style="display: none"></i> Update</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
@endsection


@push('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
           headers: {
             'X-CSRF-Token': $('meta[name="_token"]').attr('content')
           }
         });

        $('.edit_detail').on('click',function(){
            $('#updateDetails').toggle();

        });



        $('#profile_form').validator().on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            // handle the invalid form...
          } else {
            e.preventDefault();

            var url=$(this).attr('action');
            $('.loading-image').show();
             $.ajax({
                    type : 'POST',
                    url : url,
                    data : $(this).serialize(),
                    cache: false,
                    success:function(response){
                        if(response.status)
                        {
                             toastr.success(response.message);
                             setTimeout(function(){ location.reload(); }, 2000);
                             

                        }

                    },
                    complete: function(){
                        $('.loading-image').hide();
                    }
                });
           
          }
        });



    });
</script>
@endpush