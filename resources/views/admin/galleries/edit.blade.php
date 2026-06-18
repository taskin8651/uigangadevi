@extends('layouts.admin')

@section('page-title', 'Edit Gallery')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.galleries.index') }}" class="admin-back-link">
            Back to list
        </a>
        <h2 class="admin-page-title">Edit Gallery</h2>
        <p class="admin-page-subtitle">Update gallery title, category and media</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.galleries._form')

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Update Gallery
        </button>
        <a href="{{ route('admin.galleries.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>

@endsection
