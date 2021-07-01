@extends('admin.layouts.app')

@section('title', 'All Users')
@push('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

<style>
#admin .asdh-delete {
    display: none;
}

.role-wseller .asdh-edit {
    display: none;
}

.user-img {
    max-width: 80px;
}
</style>
@section('content')

  <div class="card">
    @include('extras.index_header')

    <div class="card-content">
      <ul class="nav nav-pills nav-pills-warning">
        @foreach($roles as $key=>$role)
        <?php
            $roleName =  strtolower($role->name());
            if ($roleName == 'wseller') {
                $roleName = 'Whole Seller';
            } else if ($roleName == 'normal') {
                $roleName = 'Customer';
            }
        ?>
          <li @if($key==0) class="active" @endif>
            <a href="#{{$role->name_camel_case()}}" data-toggle="tab">
              {{$roleName}} ({{$role->users->count()}})
            </a>
          </li>
        @endforeach
      </ul>

      <div class="tab-content">
        @foreach($roles as $key=>$role)
          <div class="tab-pane @if($key==0) active @endif" id="{{$role->name_camel_case()}}">
            <div class="table-responsive">
              <table class="table role-{{str_slug($role->name)}}">
                <thead>
                <tr>
                  <th width="40">SN.</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Email</th>
                  @if($role->id==4)
                  <th>Approved Status</th>
                  <th>Document</th>
                  @else
                  <th>Verified</th>

                  @endif
                  <th width="80">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($role->users()->latest()->get() as $key=>$user)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td width="60"><img class="user-img" src="{{$user->image()}}" alt="{{$user->name}}"></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if($user->hasRole('wseller'))
                    <td>

                      <div class="togglebutton">

                      <label>
                       Pending  <input  type="checkbox"
                       data-url="{{route('approved_status',$user)}}"
                       class="approve_status"
                       {{($user->isApproved==1)? 'checked':''}} > Approved
                      </label>
                    </div>
                    </td>
                    <td><a target="_blank" href="{{ asset('uploads/users/documents/'.$user->document)}}" title="Click to download">{{str_limit($user->document,20)}}</a></td>

                    @else
                    <td>{{$user->verified()}}</td>
                    @endif
                      @if(!$user->hasRole('normal'))
                        <td class="asdh-edit_and_delete td-actions">
                          @include('extras.edit_delete', ['modal'=>$user, 'message'=>'You will not be able to recover your data in the future.'])
                        </td>
                      @else
                          <td>-</td>
                      @endif
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection

@push('script')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script>
    $(document).ready(function () {
      $('table').dataTable({
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [10, 15, 20],
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        'columnDefs': [{
          'orderable': false,
          'targets': [4]
        }]
      });

      $('.approve_status').on('change',function(){
      var route_url=$(this).data('url');
      $.get(route_url,function(data){

      });
    });






    });
  </script>
@endpush
