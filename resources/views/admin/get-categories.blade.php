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
              <li class="breadcrumb-item"><a href="/admin/homr">Home</a></li>
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
            <div class="col-md-12">

                <table class="table table-striped table-bordered table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>
                                Description
                            </th>

                            <th>
                                Created At
                            </th>

                            <th>
                                Actions
                            </th>

                           



                            
                        </tr>
                    </thead>

                    <tbody>
<tr>
                        @if ($categories->count() > 0)
                            @foreach ($categories as $category)
                            <tr>
                                
                                    <td>
                                        {{$category->title}}
                                    </td>
                                    <td>
                                        {{$category->desc}}
                                    </td>
                                    <td>
                                        {{$category->created_at}}
                                    </td>

                                    <td>
                                        <a href="{{route('admin.category.update.form', ['cat_id' => $category->id])}}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"> </i> View/Edit
                                        </a>
                                        <a href="{{route('admin.category.delete', ['cat_id' => $category->id])}}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>

                                    </tr>
                                    
                              
                            @endforeach
                            
                        @else
                    <tr>
                            
                                <td colspan="3" class="text-center">
                                    <h2>No Categories Yet</h2>
                                </td>
                    </tr>
                            
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@section('additional_scripts')
  
@endsection