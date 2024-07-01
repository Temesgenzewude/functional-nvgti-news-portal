@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$page}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$page}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">{{$page}}</h3>
                  </div>
                  <!-- /.card-header -->
            @if ($settings !=null)
                  <!-- form start -->
                  <form role="form" method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                      
                     
                      <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="site_name" value="{{$settings->site_name}}" autocomplete="off" required>
                                      
                      </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="site_logo">Site Logo</label>
                            <input type="file" name="site_logo" class="form-control" id="site_logo" autocomplete="off" value="{{$settings->site_logo}}" >
                                          
                          </div>                          
                        </div>
                        
                      </div>
                      <div class="form-group">
                            <label for="site_desc">Site Description</label>
                            <textarea name="site_desc" id="site_desc" class="form-control"   >{!!$settings->site_desc!!}</textarea>                                        
                          </div>
                      
                          <div class="form-group">
                            <label for="ckeditor">About Us Section</label>
                            <textarea name="about" id="ckeditor" class="form-control"   >{{$settings->about}}</textarea>                                        
                          </div>


                      <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" class="form-control" id="facebook" value="{{$settings->facebook}}" autocomplete="off" >
                                      
                      </div>
                      <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" name="twitter" class="form-control" id="twitter" value="{{$settings->twitter}}" autocomplete="off" >
                                      
                      </div>

                      <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" class="form-control" id="instagram" value="{{$settings->instagram}}" autocomplete="off" >
                                      
                      </div>

                       <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="text" name="linkedin" class="form-control" id="linkedin" value="{{$settings->linkedin}}" autocomplete="off" >
                                      
                      </div>

                      <div class="form-group">
                        <label for="youtube">YouTube</label>
                        <input type="text" name="youtube" class="form-control" id="youtube" value="{{$settings->youtube}}" autocomplete="off" >
                                      
                      </div>


                      
                      
                      
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                
            @else
      <!-- form start -->
                  <form role="form" method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                      
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="site_name" autocomplete="off" required>
                                      
                      </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="site_logo">Site Logo</label>
                            <input type="file" name="site_logo" class="form-control" id="site_logo" autocomplete="off" >
                                          
                          </div>                          
                        </div>
                        
                      </div>
                      <div class="form-group">
                            <label for="site_desc"> Site Description</label>
                            <textarea name="site_desc" id="site_desc" class="form-control" ></textarea>                                        
                          </div>

                        <div class="form-group">
                            <label for="ckeditor">About Us Section</label>
                            <textarea name="about" id="ckeditor" class="form-control" ></textarea>                                        
                          </div>

                      <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" class="form-control" id="facebook" autocomplete="off" >
                                      
                      </div>
                      <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" name="twitter" class="form-control" id="twitter" autocomplete="off" >
                                      
                      </div>

                      <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" class="form-control" id="instagram" autocomplete="off" >
                                      
                      </div>

                       <div class="form-group">
                        <label for="linkedin">LinkedIn</label>
                        <input type="text" name="linkedin" class="form-control" id="linkedin" autocomplete="off" >
                                      
                      </div>

                      <div class="form-group">
                        <label for="youtube">YouTube</label>
                        <input type="text" name="youtube" class="form-control" id="youtube" autocomplete="off" >
                                      
                      </div>


                      
                      
                      
                    </div> 
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>

                
            @endif
                </div>

            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection