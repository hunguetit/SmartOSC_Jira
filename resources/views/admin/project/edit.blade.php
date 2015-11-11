@extends('admin.layouts.default')

@section('title','Admin | Edit Project')
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Project {{$project->projectCode}}
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Project Manager</a></li>
            <li class="active">Edit Project</li>
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
                  <h3 class="box-title">Project Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               @if (count($errors) > 0)
              <script>
                  bootbox.alert({
                        message: "@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach",
                      });
                  </script>
              @endif
                <form id="editProject" action="{{asset('admin/project/'.$project->id.'/update')}}" roll='form' method="POST" enctype="multipart/form-data">
					         {!! csrf_field() !!}
                  <div class="box-body">
                  <div class="form-group">
                      <label>Project Code</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div>
                      <input type="text" class="form-control" id="projectCode" name="projectCode" value="{{$project->projectCode}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Project Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                      </div>
                      <input type="text" class="form-control" id="projectName" name="projectName" value="{{$project->projectName}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Version</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-code-fork"></i>
                      </div>
                      <input type="number" min="1" step="0.1" class="form-control" id="projectVersion" name="projectVersion" value="{{$project->projectVersion}}">
                      </div>
                    </div>
                    <div class="form-group">
                    <label>Project Start Date:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="projectStartDate" name="projectStartDate" value="{{$project->projectStartDate}}"/>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label>Project End Date:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="projectEndDate" name="projectEndDate" value="{{$project->projectEndDate}}"/>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                      <label for="exampleInputFile">Project Charter {{strstr($project->projectCharter, '/')}}</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-file-word-o"></i>
                      </div>
                      <input type="file" id="projectCharter" name="projectCharter">
                       </div><!-- /.input group -->
                      <p class="help-block">Attachments Project Charter here.</p>
                    </div>
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


