@extends('user.layouts.default')

@section('title','User | Show Project')
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
        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-md-8">
                         
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Project Info</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li>Project Code: <a href="#"><i class="fa fa-key"></i></i> {{$project->projectCode}}</a></li>
                    <li>Project Name: <a href="#"><i class="fa fa-info"></i></i>{{$project->projectName}}</a></li>
                    <li>Project Version: <a href="#"><i class="fa fa-code-fork"></i></i>{{$project->projectVersion}}</a></li>
                    <li>Project Start Date<a href="#"><i class="fa fa-calendar"></i></i> {{$project->projectStartDate}}</a></li>
                    <li>Project End Date<a href="#"><i class="fa fa-calendar"></i></i> {{$project->projectEndDate}}</a></li>
                    <li>Project File Charter<a href="#"><i class="fa fa-file-word-o"></i></i></i> {{strstr($project->projectCharter, '/')}}</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->

                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section>
              </div>

      </div>
    </div>
    </div>
        </div>
  </div>
</div>
@stop