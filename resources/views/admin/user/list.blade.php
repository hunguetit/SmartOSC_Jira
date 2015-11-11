@extends('admin.layouts.default')

@section('title','Admin | List User')
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manager User
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User Manager</a></li>
            <li class="active">List User</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <div class="row">
         @if (count($errors) > 0)
          <script>
              bootbox.alert({
                    message: "@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach",
                  });
              </script>
          @endif

            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List User</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      
                      <div class="input-group-btn">
                      <button type="button" class="btn btn-primary btn-block margin-bottom" data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i>&nbsp&nbsp&nbsp&nbspNew User</button>
                       
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="20%">Name</th>
                      <th width="10%">User Account</th>
                      <th width="20%">Email</th>
                      <th width="20%">Team</th>
                      <th width="20%">Role</th>
                      <th width="20%">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
	                    <td class="sorting_1"><a href="{{asset('admin/user/'.$user->id)}}">{{$user->name}}</a></td>
          						<td><a href="{{asset('admin/user/'.$user->id)}}">{{$user->username}}</a></td>
          						<td>{{$user->email}}</td>
          						<td>{{$user->teamName}}</td>
          						<td>{{$user->role}}</td>
          						
                      <td>
                          <a href="#deleteModal_{{ $user->id }}" data-toggle="modal" class="btn btn-sm red"><i class="fa fa-times"></i></a>
                          <!-- Modal HTML -->
                          <div id="deleteModal_{{ $user->id }}" class="modal fade">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title" style="color:IndianRed;">Confirmation</h4>
                                      </div>
                                      <div class="modal-body" style="margin-top:-20px;">
                                          <p>Do you want to delete user account {{$user->username}} </a>?</p>
                                      </div>
                                      <div class="modal-footer" style="margin-top:-40px;">
                                          <button type="button" class="btn btn-flat btn-primary" data-dismiss="modal">No</button>
                                          <a href="{{asset('admin/user/'.$user->id.'/delete')}}" class="btn btn-danger btn-flat" style="width:90px;" data-toggle="modal">Yes</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </td>
                  
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
              </section>
              </div>


  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-create">Create New User</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{asset('admin/user')}}" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div class="box-body">
                  <div class="form-group">
                      <label>Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-male"></i>

                      </div>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>UserName</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user-md"></i>
                      </div>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Account">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Password Default</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-lock"></i>
                      </div>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Re-Password Default</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-lock"></i>
                      </div>
                      <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Enter Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope-o"></i>
                      </div>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                      </div>
                    </div>
                    <div class="form-group">
                    <label>Team</label>
                    <select name="team" id="team" class="form-control" style="width: 100%;">
                      @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->teamName}}</option>
                      @endforeach
                    </select>
                  </div><!-- /.form group -->
                  <div class="form-group">
                      <label for="exampleInputFile">Avatar</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-picture-o"></i>
                      </div>
                      <input type="file" id="avatar" name="avatar">
                       </div><!-- /.input group -->
                      <p class="help-block">Attachments Avatar here.</p>
                    </div>
                    <div style="float: right;">
                    <button type="button" class="btn btn-default"
                    data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">
                     Create
                  </button>
                  <div>
                </form>
      </div>
      </div>
    </div>
    </div>
    </div>
  </div>
</div>
@stop

