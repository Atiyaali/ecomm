@extends('admin.mainDesign')

@section('contactus')
<style>
    .message-preview {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.card-text {
    word-break: break-word;
    overflow-wrap: anywhere;
}

</style>
<div class="row g-4">
    @forelse($contact as $contact)
       <div class="col-md-6 col-lg-4 text-white">
    <div class="card h-100 shadow-sm text-white position-relative">

        {{-- Reply button on top-right --}}
        <a href="{{ route('admin.sendreply', $contact->id) }}"
           class="btn btn-success btn-sm position-absolute"
           style="top: 10px; right: 10px; z-index: 10;">
            Reply
        </a>

        <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-1">{{ $contact->name }}</h5>
            <p class="small mb-2">
                <a href="{{ route('admin.sendreply', $contact->id) }}">{{ $contact->email }}</a>
                <br>
                {{ $contact->phone }}
                <br>
         @if($contact->replies->count() > 0)
    <a href="{{ route('admin.replies', $contact->id) }}" class="badge bg-success">
        Replies
    </a>
@endif

            </p>

            <p class="card-text flex-grow-1">
                {{ \Illuminate\Support\Str::limit($contact->message, 120) }}
            </p>


            <small class="mb-3">
                {{ $contact->created_at->format('d M, Y') }}
            </small>

            <div class="d-flex justify-content-between mt-auto">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#msg{{ $contact->id }}">
                    View
                </button>

                <a href="{{ route('admin.deletemessage', $contact->id) }}"
                   onclick="return confirm('Are you sure you want to delete this message?')"
                   class="btn btn-danger btn-sm">
                    Delete
                </a>
            </div>
        </div>
    </div>
</div>


        {{-- Modal --}}
   <div class="modal fade" id="msg{{ $contact->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message from {{ $contact->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="white-space: pre-wrap;">
                    {!! nl2br(e($contact->message)) !!}
                </p>
            </div>
        </div>
    </div>
</div>


    @empty
        <p class="text-center">No messages found</p>
    @endforelse
</div>

@endsection
