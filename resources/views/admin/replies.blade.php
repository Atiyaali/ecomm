@extends('admin.mainDesign')
<base href="/public">
@section('replies')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4 text-white">
        <h2>Replies to {{ $contact->name }}</h2>

        <a href="{{ route('admin.sendreply', $contact->id) }}"
           class="btn btn-success">
            Send New Reply
        </a>
    </div>

    {{-- Original Message --}}
    <div class="card mb-4 text-white">
         <div class="card-header fw-bold text-white d-flex justify-content-between">
                    <span>Orignal Message</span>
                    <small>{{ $contact->created_at->format('d M, Y h:i A') }}</small>
                </div>

        <div class="card-body text-white">
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Message:</strong></p>
            <p style="white-space: pre-wrap;">
                {{ $contact->message }}
            </p>
        </div>
    </div>

    {{-- Replies --}}
    <h4 class="mb-3 text-white">Admin Replies</h4>

    @if($contact->replies->count() > 0)
        @foreach($contact->replies as $reply)
            <div class="card mb-3 border-success text-white">
                <div class="card-header bg-success text-white d-flex justify-content-between">
                    <span>Reply</span>
                    <small>{{ $reply->created_at->format('d M, Y h:i A') }}</small>
                </div>

                <div class="card-body text-white">
                    <p><strong>Subject:</strong> {{ $reply->subject }}</p>
                    <p style="white-space: pre-wrap;" class="text-white">
                        {{ $reply->message }}
                    </p>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-muted">No replies sent yet.</p>
    @endif

</div>
@endsection
