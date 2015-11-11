@extends('user.layouts.default')

@section('title','User | Show Task')
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
        <!-- Main content -->
        <section class="content">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> {{$task->taskCode}}
                <small class="pull-right">Create Date: {{$task->taskStartDate}}</small>
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
                    <td>{{$task->taskCode}}</td>
                  </tr>
                  <tr>
                    <th>Task Name:</th>
                    <td>{{$task->taskName}}</td>
                  </tr>
                  <tr>
                    <th>Task Content:</th>
                    <td>{{$task->taskContent}}</td>
                  </tr>
                  <tr>
                    <th>Project Code:</th>
                    <td>{{$task->projectCode}}</td>
                  </tr>
                </table>
              </div>
            </div><!-- /.col -->
  <div class="row">
            <div class="col-md-12">
            <form action="{{asset('user/task/'.Auth::user()->id.'/'.$task->id.'/update')}}" roll='form' method="POST">
                {!! csrf_field() !!}
                <div class="portlet">
                    <div class="portlet-body">
                        <div class="tabbable">
                            <div class="tab-content no-space">
                                <div class="tab-pane active" id="tab_general">
                                    <div class="form-body">
                                        <div class="form-group style-group-edit">
                                            <label class="col-md-2 control-label">Done
                                                <span class="required">* </span>
                                            </label>
                                            @if ($task->taskStatus == '1')
                                            <div class="col-md-1">
                                                <input onclick="this.checked=!this.checked;" type="checkbox" class="form-control" name="shipped" checked="checked">
                                            </div>
                                            @else
                                            @if ($task->taskStatus == '0')
                                            <div class="col-md-12">
                                                <input type="checkbox" class="form-control " name="shipped" style="width: 50px">
                                                <br></br>
                                                <button type="submit" class="btn btn-primary" style="float: right;">UPDATE</button>
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                
            </div>
            
            </div>

            </div>
        </div>
    </div>
    </form>
            </div>
        </div>
          </section>

@stop