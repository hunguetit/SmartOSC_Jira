@extends('admin.layouts.default')

@section('title','Admin | Show User Profile')
@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manager User
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User Manager</a></li>
            <li class="active">Show User Profile</li>
          </ol>
        </section>
        @if (count($errors) > 0)
              <script>
                  bootbox.alert({
                        message: "@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach",
                      });
                  </script>
              @endif
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->avatar) }}" alt="User profile picture">
                  <h3 class="profile-username text-center">{{ $user->name}}</h3>
                  <p class="text-muted text-center">{{ $user->teamName}}</p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      Account: <b>{{ $user->username }}</b>
                    </li>
                    <li class="list-group-item">
                      Email: <b>{{ $user->email }}</b>
                    </li>
                  </ul>

                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#task" data-toggle="tab">Tasks</a></li>
                  <li><a href="#editProfile" data-toggle="tab">Edit User</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="task">
                    <div class="box-body no-padding">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                      @foreach ($tasks as $task)
                        <tr>
                          <td><input type="checkbox"></td>
                          <td class="mailbox-name"><a href="{{asset('admin/task/'.$task->project_id.'/'.$task->id)}}" class="btn btn-sm green" id="my-button">{{$task->taskCode}}</a></td>
                          <td class="mailbox-subject"><b>{{$task->taskName}}</b></td>
                          <td class="mailbox-subject">{{htmlentities($task->taskContent)}}</td>
                          <td class="mailbox-date"><a href="{{asset('admin/project/'.$task->project_id)}}" class="btn btn-sm green" id="my-button">{{$task->projectCode}}</a></td>
                          @if ($task->taskStatus == '1')
                            <td><span class="label label-success">Done</span></td>
                          @else
                          @if ($task->taskStatus == '0')
                            <td><span class="label label-warning">In Process</span></td>
                          @else
                          @endif
                          @endif
                          <td class="mailbox-date">{{$task->taskStartDate}}</td>
                          <td class="mailbox-date">{{$task->taskEndDate}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table><!-- /.table -->
                     {!! $tasks->render() !!}
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="editProfile">
                    <form class="form-horizontal" action="{{asset('admin/user/'.$user->id.'/update')}}" roll='form' method="POST" enctype="multipart/form-data">
                    @if (count($errors) > 0)
              <script>
                  bootbox.alert({
                        message: "@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach",
                      });
                  </script>
              @endif {!! csrf_field() !!}
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="name" value="{{ $user->name}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputUsername" name="username" value="{{ $user->username}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $user->email}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputTeam" class="col-sm-2 control-label">Team</label>
                        <div class="col-sm-10">
                          <select class="form-control" id="inputTeam" name="team">
                          <option value="{{ $user->team_id}}" selected="selected">{{ $user->teamName}}</option>
                          @foreach ($teams as $team)
                          <option value="{{ $team->id}}">{{ $team->teamName}}</option>
                          @endforeach
                          </select>

                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
              </div>

        </div>
  </div>
</div>
@stop