    @extends('user.dashboard')
    @section('main')
        <!-- Load jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            span.select2.select2-container.select2-container--classic {
                width: 100% !important;
                height: 38px;
            }
        </style>
        <style>
            .ck-editor__editable_inline {
                height: 200px;
            }
        </style>

        <div class="container-fluid">
            <h4>Notes Form</h4>
            <form method="post"
                action="{{ isset($note) ? route('notes.update') : route('notes.store') }}">
                @csrf
                @if (isset($note))
                    @method('PUT')
                    <input type="hidden" name="note_id" value="{{ $note->id }}">
                @endif
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-2">
                            <div class="col-sm-12 d-sm-flex align-items-center justify-content-between">
                                <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-solid fa-square-plus text-white-50"></i>
                                    {{ isset($note) ? 'Update Note' : 'Add Note' }}
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="col-sm-12 mb-2">
                                    @if (session('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <input type="text" name="category" class="form-control form-control-user"
                                        placeholder="Enter Category..."
                                        value="{{ isset($note) ? $note->category : old('category') }}">
                                </div>

                                <div class="col-sm-12 mb-2">
                                    <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                        @if (isset($note))
                                            @if (is_array($note->tags))
                                                {{-- Display each tag separately --}}
                                                @php
                                                    $tagsArray = json_decode($note->tags);
                                                @endphp

                                                @foreach ($tagsArray as $tag)
                                                    <option value="{{ $tag }}" selected>{{ $tag }}
                                                    </option>
                                                @endforeach
                                            @else
                                                {{-- Handle the case where $note->tags is a string --}}
                                                <option value="{{ $note->tags }}" selected>{{ $note->tags }}</option>
                                            @endif
                                        @endif
                                    </select>
                                </div>

                                <div class="col-sm-12 mb-2">
                                    <textarea class="form-control editor" id="editor" name="note" placeholder="Enter your notes here...">{{ isset($note) ? $note->note : old('notes') }}</textarea>
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
            $('.js-example-basic-multiple').select2({
                theme: "classic",
                tags: true,
                placeholder: "Enter Tags...",
            });
        </script>
    @endsection
