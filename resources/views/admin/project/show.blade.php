@extends('admin.layouts.default')

@section('title','Admin | Show Project')
@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manager Project
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Project Manager</a></li>
            <li class="active">Show Project</li>
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
            <button type="button" class="btn btn-primary btn-block margin-bottom" data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i>&nbsp&nbsp&nbsp&nbspNew Task</button>
              <!-- <a href="{{asset('admin/task/'.$projectInfo->id.'/create')}}" class="btn btn-primary btn-block margin-bottom">New Task</a> -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Project Info</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-key"></i></i> {{$projectInfo->projectCode}}</a></li>
                    <li><a href="#"><i class="fa fa-info"></i></i>{{$projectInfo->projectName}}</a></li>
                    <li><a href="#"><i class="fa fa-code-fork"></i></i>{{$projectInfo->projectVersion}}</a></li>
                    <li><a href="#"><i class="fa fa-calendar"></i></i> {{$projectInfo->projectStartDate}}</a></li>
                    <li><a href="#"><i class="fa fa-calendar"></i></i> {{$projectInfo->projectEndDate}}</a></li>
                    <li><a href="#"><i class="fa fa-file-word-o"></i></i></i> {{strstr($projectInfo->projectCharter, '/')}}</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Member</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                  @foreach ($users as $user)
                    <li><a href="{{asset('admin/user/'.$user->id)}}"><i class="fa fa-user"></i> {{$user->username}}</a></li>
                  @endforeach
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tasks</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Tasks">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
                      @foreach ($tasksProject as $taskProject)
                        <tr>
                          <td><input type="checkbox"></td>
                          <td class="mailbox-name"><a href="{{asset('admin/task/'.$projectInfo->id.'/'.$taskProject->id)}}">{{$taskProject->taskCode}}</a></td>
                          <td class="mailbox-subject"><b>{{$taskProject->taskName}}</b></td>
                          @if ($taskProject->taskStatus == '1')
                            <td><span class="label label-success">Done</span></td>
                          @else
                          @if ($taskProject->taskStatus == '0')
                            <td><span class="label label-warning">In Process</span></td>
                          @else
                          @endif
                          @endif
                          <td class="mailbox-date">{{$taskProject->taskStartDate}}</td>
                          <td class="mailbox-date">{{$taskProject->taskEndDate}}</td>
                          <td><a href="{{asset('admin/task/'.$projectInfo->id.'/'.$taskProject->id)}}" class="btn btn-sm green" id="my-button"><i class="fa fa-eye"></i></a></td>
                          <td><a href="{{asset('admin/task/'.$projectInfo->id.'/'.$taskProject->id.'/edit')}}" class="btn btn-sm yellow"><i class="fa fa-pencil"></i></a></td>
                          
                          <td>
                              <a href="#deleteModal_{{ $taskProject->id }}" data-toggle="modal" class="btn btn-sm red"><i class="fa fa-times"></i></a>
                              <!-- Modal HTML -->
                              <div id="deleteModal_{{ $taskProject->id }}" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title" style="color:IndianRed;">Confirmation</h4>
                                          </div>
                                          <div class="modal-body" style="margin-top:-20px;">
                                              <p>Do you want to delete this task {{$taskProject->taskCode}} </a>?</p>
                                          </div>
                                          <div class="modal-footer" style="margin-top:-40px;">
                                              <button type="button" class="btn btn-flat btn-primary" data-dismiss="modal">No</button>
                                              <a href="{{asset('admin/task/'.$projectInfo->id.'/'.$taskProject->id.'/delete')}}" class="btn btn-danger btn-flat" style="width:90px;" data-toggle="modal">Yes</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>

                    </table><!-- /.table -->
                {!! $tasksProject->render() !!}
                  </div><!-- /.mail-box-messages -->

                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section>
              </div>

                <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-create">Create New Task</h4>
      </div>
      <div class="modal-body">
<form id="createTask" action="{{asset('admin/task/'.$projectInfo->id)}}" roll='form' method="POST" >
                   {!! csrf_field() !!}
                  <div class="box-body">
                  <div class="form-group">
                      <label>Project Code</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-anchor"></i>
                      </div>
                      <input type="text" class="form-control" id="taskCode" name="taskCode" value="{{$projectInfo->projectCode}}" readonly="readonly" disabled="disabled">
                      </div>
                    </div>
                  <div class="form-group">
                      <label>Task Code</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-map-pin"></i>
                      </div>
                      <input type="text" class="form-control" id="taskCode" name="taskCode" placeholder="Enter Task Code">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Task Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                      </div>
                      <input type="text" class="form-control" id="taskName" name="taskName" placeholder="Enter Task Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Task Content</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                       <i class="fa fa-sticky-note-o"></i>
                      </div>
                      <textarea class="form-control" id="taskContent" name="taskContent" placeholder="Enter Task Content"></textarea>
                      
                      </div>
                    </div>
                    <script>
                      CKEDITOR.replace( 'taskContent' );
                  </script>
                    <div class="form-group">
                    <label>Task Start Date:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="projectStartDate" name="taskStartDate" value="{{ date('Y-m-d') }}"/>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label>Task End Date:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="taskEndDate" name="taskEndDate" value="{{ date('Y-m-d') }}"/>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label>Assign Team</label>
                    <select id="assignTeam" class="form-control" style="width: 100%;">
                      @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->teamName}}</option>
                      @endforeach
                    </select>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <label>Assign Account Member</label>
                    <select name="userTask[]" id="userTask" class="form-control" multiple="multiple" data-placeholder="Select a User" style="width: 100%;">
                      @foreach($usersTask as $userTask)
                        @if ($userTask->role == 'admin')
                        <option value="{{$userTask->id}}"></option>
                        @else
                        <option value="{{$userTask->id}}">{{$userTask->username}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div><!-- /.form-group -->
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