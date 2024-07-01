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
           
                
         
      <!-- form start -->
                  <form role="form" method="post" action="{{route('admin.post.create')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                      
                      
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" name="title" class="form-control" id="title" autocomplete="off" required>
                                      
                      </div>

                       <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control"  id="category_id">


                            @if($categories->count()>0){
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            }
                            @else{
                                <option value="0">No Category Found</option>
                            }
                            @endif

                            
                        </select>
                                      
                      </div>

                      <div class="form-group">
                        <label for="is_special">Is the Post Special</label>
                        <select name="is_special" class="form-control"  id="is_special">
                            <option value="0">No</option>
                            <option value="1">Yes</option>

                        </select>
                                      
                      </div>


                    <div class="form-group">
                        <label for="is_breaking">Is the Post Breaking</label>
                        <select name="is_breaking" class="form-control"  id="is_breaking">
                            <option value="0">No</option>
                            <option value="1">Yes</option>

                        </select>
                                      
                    </div>



                        

                        <div class="form-group">
                            <label for="short_desc">Short Description</label>
                            <textarea name="short_desc" id="short_desc" class="form-control" cols="20" rows="5"></textarea>                                        
                        </div>
                        
                       
                          <div class="form-group">
                            <label for="image">Post Image</label>
                            <input type="file" name="image" class="form-control" id="image" autocomplete="off" >
                                          
                          </div>                          
                 
                          <div class="form-group">
                            <label for="ckeditor">Description</label>
                            <textarea name="desc" id="ckeditor" class="form-control" ></textarea>                                        
                          </div>

                           <input type="number" name="user_id"  value="{{auth()->id()}}" class="form-control"  autocomplete="off" hidden >
                       

                     


                      
                      </div>
                      
                    </div> 
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>

                
         
                </div>

            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection