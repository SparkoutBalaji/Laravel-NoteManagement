@extends('user.dashboard')
@section('main')
   <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Notes</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-solid fa-square-plus text-white-50"></i> Add Notes</a>
    </div>
    <div class="row">
    <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="chart-area">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="category" class="form-control form-control-user"
                                                placeholder="Enter Category..." value="{{ old('category') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="tags" class="form-control form-control-user"
                                                placeholder="Enter Tags..." value="{{ old('tags') }}">
                            </div>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="body">{{ old('body') }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection
