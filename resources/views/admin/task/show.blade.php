@extends('admin.layouts.default')

@section('title','Admin | Show Task')
@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manager Task
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Task Manager</a></li>
            <li class="active">Show Task</li>
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
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> {{$taskInfo->taskCode}}
                <small class="pull-right">Create Date: {{$taskInfo->taskStartDate}}</small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
			 <div class="col-xs-6">
              <p class="lead">Task Info</p>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Task Code:</th>
                    <td>{{$taskInfo->taskCode}}</td>
                  </tr>
                  <tr>
                    <th>Task Name:</th>
                    <td>{{$taskInfo->taskName}}</td>
                  </tr>
                  <tr>
                    <th>Task Content:</th>
                    <td>{{$taskInfo->taskContent}}</td>
                  </tr>
                </table>
              </div>
            </div><!-- /.col -->

          <!-- Table row -->
          <div class="row">
             <div class="col-xs-6">
              <p class="lead">Member</p>
              <div class="table-responsive">
                <table class="table">
                @foreach ($taskUsers as $taskUser)
                  <tr>
                    <th style="width:50%"><a href="{{asset('admin/user/'.$taskUser->id)}}">{{$taskUser->username}}</a></th>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section>

@stop