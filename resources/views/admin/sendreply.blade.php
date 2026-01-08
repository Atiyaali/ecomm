@extends('admin.mainDesign')
<base href="/public">
@section('reply')
<div class="container py-4">
    <h2 class="mb-4">Reply to {{ $contact->name }}</h2>

    {{-- Success message --}}
    @if(session('reply_sent'))
        <div class="alert alert-success">
            {{ session('reply_sent') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.postreply', $contact->id) }}"  method="POST">
                @csrf

                {{-- Recipient --}}
                <div class="mb-3">
                    <label class="form-label">To:</label>
                    <input type="email" class="form-control" value="{{ $contact->email }}" disabled>
                </div>

                {{-- Subject --}}
                <div class="mb-3">
                    <label class="form-label">Subject:</label>
                    <input type="text" name="subject" class="form-control" placeholder="Enter email subject" required>
                </div>

                {{-- Message --}}
                <div class="mb-3">
                    <label class="form-label">Message:</label>
                    <textarea name="message" class="form-control" rows="8" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send"></i> Send Reply
                    </button>
                    <a href="/" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
