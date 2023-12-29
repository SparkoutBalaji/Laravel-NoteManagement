@extends('user.dashboard')
@section('title', 'Category Notes List')
@section('main')
<style>
    .btn{
        width: 80px;
        height: 40px;
    }
</style>
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

                                <td>{{ implode(', ', json_decode($note->tags)) }}</td>
                                <td>{!! $note->note !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <form method="POST" action="{{ route('notes.edit') }}">
                                            @csrf
                                            <input type="hidden" name="note" value="{{ $note->id }}">
                                            <button type="submit" class="btn btn-info">Edit</button>
                                        </form>
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
@endsection
