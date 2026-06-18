@extends('layouts.admin')

@section('page-title', 'Edit Hero Slide')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.hero-slides.index') }}" class="admin-back-link">Back to list</a>
        <h2 class="admin-page-title">Edit Hero Slide</h2>
        <p class="admin-page-subtitle">Update homepage hero slider item</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST" action="{{ route('admin.hero-slides.update', $heroSlide) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.hero-slides._form')

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Update Slide
        </button>
        <a href="{{ route('admin.hero-slides.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>

@endsection
