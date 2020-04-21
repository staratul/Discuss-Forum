@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Add Discussion</div>

    <div class="card-body">
        <form action="{{ route('discussions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="hidden" name="content" id="content">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="channel">Channel</label>
                <select class="form-control" id="channel" name="channel">
                    @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}">
                            {{ $channel->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success rounded-0">Create Discussion
            </button>
        </form>
    </div>
</div>
@endsection



@section('css')
    <link href="{{ asset('css/trix.css') }}" rel="stylesheet">
@endsection



@section('scripts')
    <script src="{{ asset('js/trix.js') }}"></script>
@endsection