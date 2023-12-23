@extends('user.dashboard')
@section('main')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline
        {
            height: 200px;
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
                                <select class="js-example-basic-single form-control form-control-user" name="tags[]"
                                    value="{{ old('tags[]') }}" multiple>
                                </select>
                                </select>
                                {{-- <select class="js-example-basic-single form-control form-control-user" name="tags[]" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select> --}}
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
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $('.js-example-basic-single').select2({
            theme: "classic",
            tags: true,
            placeholder: "Enter Tags",
        });
    </script>
@endsection
