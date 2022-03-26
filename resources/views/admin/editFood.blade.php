@extends('admin.admin') @section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Form elements </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Default form</h4>
                        <p class="card-description"> Basic form layout </p>
                        <form action="{{url('updatefood/'.$row->id)}}" method="post" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Food Title</label>
                                <input type="text" name="fname" value="{{$row->title}}" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Food Price</label>
                                <input type="number" name="fprice" value="{{$row->price}}" class="form-control" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <input type="file" name="fimg" class="form-control" placeholder="Image">
                                <img src="{{asset('admin/food/'.$row->img)}}" style="width:80px; height:80px" alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Descripition</label>
                                <input type="text" name="fdes" class="form-control" value="{{$row->description}}" placeholder="Descripition">
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-dark">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
        </div>
    </footer>
    <!-- partial -->
</div>
@endsection