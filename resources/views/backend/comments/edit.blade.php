@extends('backend.layouts.main', ['title' => 'Edit Comment'])

@section('body')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Comment</h3>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name (Tidak bisa diedit) -->
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control"
                                value="{{ old('name', $comment->name) }}" disabled>
                        </div>

                        <!-- Email (Tidak bisa diedit) -->
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control"
                                value="{{ old('email', $comment->email) }}" disabled>
                        </div>

                        <!-- Content (Tidak bisa diedit) -->
                        <div class="form-group mb-3">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="4" required disabled>{{ old('content', $comment->content) }}</textarea>
                        </div>

                        <!-- Status (Bisa diedit) -->
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="pending" {{ $comment->status === 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved" {{ $comment->status === 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="rejected" {{ $comment->status === 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
