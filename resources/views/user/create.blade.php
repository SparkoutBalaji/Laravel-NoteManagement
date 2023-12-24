@extends('user.dashboard')
@section('main')
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            span.select2.select2-container.select2-container--classic{
            width: 100% !important;
            height: 38px;
            }
            .select2-search__field{
                width: 100% !important;
                height: 26px !important;
            }
        </style>
    <div class="container-fluid">
        <form method="post" action="{{ route('notes.store', ['id' => $user->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-2">
                        <div class="col-sm-12 d-sm-flex align-items-center justify-content-between">
                            <h1 class="h3 text-gray-800">Create Notes</h1>
                            <button type="submit" class=" d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-solid fa-square-plus text-white-50"></i> Add Notes
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12 mb-2">
                                <input type="text" name="category" class="form-control form-control-user"
                                    placeholder="Enter Category..." value="{{ old('category') }}">
                            </div>

                            <div class="col-sm-12 mb-2">
                                <select class="js-example-basic-single" name="tags[]" multiple>
                                    <option value="" disabled selected>Enter Tags</option>
                                </select>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <textarea class="form-control editor" id="editor" name="notes" placeholder="Enter your notes here...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Load Select2 after jQuery -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" async></script>

   <!-- Other scripts -->
   <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
   <script>
       ClassicEditor
           .create(document.querySelector('#editor'))
           .catch(error => {
               console.error(error);
           });
   </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.js-example-basic-single').select2({
        theme: "classic",
        tags: true,
        placeholder: "Enter Tags...",
    });
</script>
@endsection

