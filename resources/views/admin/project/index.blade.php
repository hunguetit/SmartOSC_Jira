@extends('admin.layouts.default')

@section('title','Admin | Home')
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
            <li class="active"> Index</li>
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
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-rocket"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Project</span>
                  <span class="info-box-number">{{$projectsCount}}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-tasks"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Tasks</span>
                  <span class="info-box-number">{{$tasksCount}}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Users Member</span>
                  <span class="info-box-number">{{$users}}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <p class="text-center">
                        <strong>Projects Completion</strong>
                      </p>
                      @foreach($percents as $percent)
                      @if ($percent['percent'] == 100)
                      <div class="progress-group">
                        <span class="progress-text"><a href="{{asset('admin/project/'.$percent['project_id'])}}" class="btn btn-sm blue" id="my-button">{{$percent['project_code']}}</a></span>
                        <span class="progress-number"><b>{{$percent['taskDone']}}</b>/{{$percent['tasks']}}</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-aqua" style="width: {{$percent['percent']}}%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      @else
                      <div class="progress-group">
                        <span class="progress-text"><a href="{{asset('admin/project/'.$percent['project_id'])}}" class="btn btn-sm blue" id="my-button">{{$percent['project_code']}}</a></span>
                        <span class="progress-number"><b>{{$percent['taskDone']}}</b>/{{$percent['tasks']}}</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-yellow" style="width: {{$percent['percent']}}%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      @endif
                      @endforeach
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section>
              </div>

                
    </div>
    </div>
        </div>
  </div>
</div>
@stop