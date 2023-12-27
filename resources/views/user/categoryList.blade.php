@extends('user.dashboard')
@section('title', 'Category Notes List')
@section('main')
<div class="container">
    <h4>Notes List - {{ $categoryName }}</h4>

    @if ($userNotes->count() > 0)
        <div class="card shadow mb-2">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tags</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $note)
                            <tr>
                                <td>{{ $note->tags }}</td>
                                <td>{!! $note->note !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:void(0);"
                                            onclick="showNote('{{ $categoryName }}', '{{ $note->tags }}', '{!! addslashes($note->note) !!}')"
                                            class="btn btn-primary">Show</a> &nbsp; &nbsp;
                                        <a href="{{ route('notes.edit', ['note' => $note->id]) }}"
                                            class="btn btn-info">Edit</a>
                                        &nbsp; &nbsp;
                                        <form method="POST" action="{{ route('notes.destroy') }}"
                                            onsubmit="return confirm('Are you sure to Delete this Note?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <input type="hidden" name="Note" value="{{ $note->id }}">
                                            <button type="submit" class="btn btn-warning">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p>No notes found for {{ $user->name }} in the selected category.</p>
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
function showNote(categoryName, tags, note) {

    $('#modalCategory').text(categoryName);
    $('#modalTags').text(tags);
    $('#modalNote').html(note);
    $('#showNoteModal').modal('show');
}
</script>
@endsection
