@extends('user.dashboard')
@section('title', 'Notes List')
@section('main')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <div class="container">
        <h4>Notes List</h4>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
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
                                    <td colspan="3" class="bg-light"><strong>Category: {{ $category }}</strong></td>
                                </tr>
                                @foreach ($notesInCategory as $note)
                                    <tr>
                                        <td>{{ $note->category }}</td>

                                        <td>{{ implode(', ', json_decode($note->tags)) }}</td>

                                        <td>{!! $note->note !!}</td>
                                        <td>
                                            <div class="btn-group">
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
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        @else
            <p>{{ $user->name }} not have a Notes.</p>
        @endif

    </div>

@endsection


{{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form> --}}
