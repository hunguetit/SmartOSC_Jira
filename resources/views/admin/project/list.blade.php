@extends('admin.layouts.default')

@section('title','Admin | List Project')
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manager Project
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Project Manager</a></li>
            <li class="active">List Project</li>
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
                  <h3 class="box-title">List Of Project</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      
                      <div class="input-group-btn">
                      <button type="button" class="btn btn-primary btn-block margin-bottom" data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i>&nbsp&nbsp&nbsp&nbspNew Project</button>
                       
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="20%">Project Code</th>
                      <th width="20%">Project Name</th>
                      <th width="10%">Project Version</th>
                      <th width="20%">Project Start Date</th>
                      <th width="20%">Project End Date</th>
                      <th width="20%">Project Charter</th>
                      <th width="20%">Project Status</th>
                      <th width="20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($projects as $project)
                    <tr>
	                    <td class="sorting_1">{{$project->projectCode}}</td>
						<td>{{$project->projectName}}</td>
						<td>{{$project->projectVersion}}</td>
						<td>{{$project->projectStartDate}}</td>
						<td>{{$project->projectEndDate}}</td>
						<td>{{$project->projectCharter}}</td>
						@if ($project->projectStatus == '1')
							<td><span class="label label-success">Done</span></td>
						@else
						@if ($project->projectStatus == '0')
							<td><span class="label label-warning">In Process</span></td>
						@else
						@endif
						@endif
						<td><a href="{{asset('admin/project/'.$project->id)}}" class="btn btn-sm green" id="my-button"><i class="fa fa-eye"></i></a></td>
						<td><a href="{{asset('admin/project/'.$project->id.'/edit')}}" class="btn btn-sm yellow"><i class="fa fa-pencil"></i></a></td>
						
            <td>
                <a href="#deleteModal_{{ $project->id }}" data-toggle="modal" class="btn btn-sm red"><i class="fa fa-times"></i></a>
                <!-- Modal HTML -->
                <div id="deleteModal_{{ $project->id }}" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" style="color:IndianRed;">Confirmation</h4>
                            </div>
                            <div class="modal-body" style="margin-top:-20px;">
                                <p>Do you want to delete the project {{$project->projectCode}} </a>?</p>
                            </div>
                            <div class="modal-footer" style="margin-top:-40px;">
                                <button type="button" class="btn btn-flat btn-primary" data-dismiss="modal">No</button>
                                <a href="{{asset('admin/project/'.$project->id.'/delete')}}" class="btn btn-danger btn-flat" style="width:90px;" data-toggle="modal">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
                  
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  {!! $projects->render() !!}
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
        <h4 class="modal-title" id="modal-create">Create New Project</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{asset('admin/project')}}" enctype="multipart/form-data">
                   {!! csrf_field() !!}
                  <div class="box-body">
                  <div class="form-group">
                      <label>Project Code</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div>
                      <input type="text" class="form-control" id="projectCode" name="projectCode" placeholder="Enter Project Code">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Project Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                      </div>
                      <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Enter Project Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Version</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-code-fork"></i>
                      </div>
                      <input type="number" min="1" step="0.1" class="form-control" id="projectVersion" name="projectVersion" placeholder="Version">
                      </div>
                    </div>
                    <div class="form-group">
                    <label>Project Start Date:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="projectStartDate" name="projectStartDate" value="{{ date('Y-m-d') }}"/>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                    <label>Project End Date:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="projectEndDate" name="projectEndDate" value="{{ date('Y-m-d') }}"/>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
                      <label for="exampleInputFile">Project Charter</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-file-word-o"></i>
                      </div>
                      <input type="file" id="projectCharter" name="projectCharter">
                       </div><!-- /.input group -->
                      <p class="help-block">Attachments Project Charter here.</p>
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

