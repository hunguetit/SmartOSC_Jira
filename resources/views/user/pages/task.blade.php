@extends('user.layouts.default')

@section('title','User | List Project')
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manager Task
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Task Manager</a></li>
            <li class="active">List Task</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <div class="row">

            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List Of Task</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      
                      <div class="input-group-btn">
                      
                       
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="20%">Task Code</th>
                      <th width="20%">Task Name</th>
                      <th width="10%">Task Content</th>
                      <th width="20%">Project Code</th>
                      <th width="20%">Task Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                    <tr>
	                    <td class="sorting_1"><a href="{{asset('user/task/'.Auth::user()->id.'/'.$task->id)}}" class="btn btn-sm green" id="my-button">{{$task->taskCode}}</a></td>
						<td>{{$task->taskName}}</td>
						<td>{{$task->taskContent}}</td>
						<td><a href="{{asset('user/project/'.Auth::user()->id.'/'.$task->projectCode)}}" class="btn btn-sm green" id="my-button">{{$task->projectCode}}</a></td>
						@if ($task->taskStatus == '1')
							<td><span class="label label-success">Done</span></td>
						@else
						@if ($task->taskStatus == '0')
							<td><span class="label label-warning">In Process</span></td>
						@else
						@endif
						@endif
	
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  {!! $tasks->render() !!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
              </section>
              </div>

    </div>
  </div>
</div>
@stop

