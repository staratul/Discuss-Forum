<div class="card-header">
    <div class="d-flex justify-content-between">
        <div>
            <img src="{{ Gravatar::src($discussion->author->email) }}" style="border-radius: 50%" height="40" width="40">
            <strong class="ml-2">{{ $discussion->author->name }}</strong>
        </div>
        <div>
            <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success rounded-0 btn-sm">View</a>
        </div>
    </div>
</div>