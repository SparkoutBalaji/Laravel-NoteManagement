@extends('user.dashboard')
@section('main')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <div class="container">
        <h4>Notes List</h4>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($userNotes->count() > 0)
            <div class="card shadow mb-2">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userNotes->groupBy('category') as $category => $notesInCategory)
                                <tr>
                                    <td colspan="4" class="bg-light"><strong>Category: {{ $category }}</strong></td>
                                </tr>
                                @foreach ($notesInCategory as $note)
                                    <tr>
                                        <td>{{ $category }}</td>
                                        <td>{{ $note->tags }}</td>
                                        <td>{!! $note->note !!}</td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                onclick="showNote('{{ $category }}', '{{ $note->tags }}', '{!! addslashes($note->note) !!}')"
                                                class="btn btn-primary">Show</a>
                                            <a href="{{ route('notes.edit', ['user' => $user->id, 'note' => $note->id]) }}"
                                                class="btn btn-info">Edit</a>
                                            <form method="POST" action="{{ route('notes.destroy') }}"
                                                onsubmit="return confirm('Are you sure to Delete this Notes..?');">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <input type="hidden" name="Note" value="{{ $note->id }}">
                                                <button type="submit" class="btn btn-warning">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p>No notes found for {{ $user->name }}.</p>
        @endif
    </div>
    <!-- Modal for Show Action -->
    <div class="modal fade" id="showNoteModal" tabindex="-1" role="dialog" aria-labelledby="showNoteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showNoteModalLabel">Show Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="showNoteModalBody">
                    <!-- Content will be loaded here using JavaScript -->
                    <h5>Category: <span id="modalCategory"></span></h5>
                    <p><strong>Tags:</strong> <span id="modalTags"></span></p>
                    <p><strong>Note:</strong> <span id="modalNote"></span></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Script for showNote function -->
    <script>
        function showNote(category, tags, note) {
            // Set modal content
            $('#modalCategory').text(category);
            $('#modalTags').text(tags);
            $('#modalNote').html(note);

            // Open the modal
            $('#showNoteModal').modal('show');
        }
    </script>
@endsection
