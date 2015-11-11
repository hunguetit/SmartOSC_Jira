@extends('admin.layouts.default')

@section('title','Admin | Edit Task')
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Create Task
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Task Manager</a></li>
            <li class="active">Edit Task</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Task Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               @if (count($errors) > 0)
              <script>
                  bootbox.alert({
                        message: "@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach",
                      });
                  </script>
              @endif
                <form id="createTask" action="{{asset('admin/task/'.$projectInfo->id.'/'.$task->id.'/update')}}" roll='form' method="POST" >
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
                      <input type="text" class="form-control" id="taskCode" name="taskCode" value="{{$task->taskCode}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Task Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                      </div>
                      <input type="text" class="form-control" id="taskName" name="taskName" value="{{$task->taskName}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Task Content</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                       <i class="fa fa-sticky-note-o"></i>
                      </div>
                      <textarea class="form-control" id="taskContent" name="taskContent" value="{{$task->taskContent}}"></textarea>
                      
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
                      <input type="text" class="form-control pull-right" id="projectStartDate" name="taskStartDate" value="{{$task->taskStartDate}}"/>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label>Task End Date:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="taskEndDate" name="taskEndDate" value="{{$task->taskEndDate}}"/>
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
                    @foreach($taskUsers as $taskUser)
                    <option value="{{$taskUser->id}}" selected="selected">{{$taskUser->username}}</option>
                    @endforeach
                      @foreach($usersTask as $userTask)
                        @if ($userTask->role == 'admin')
                        <option value="{{$userTask->id}}"></option>
                        @else
                        <option value="{{$userTask->id}}">{{$userTask->username}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div><!-- /.form-group -->
                  <div class="box-footer" style="float: right;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
              </div>
              </div>
              </div>
              </section>
              </div>
@stop




