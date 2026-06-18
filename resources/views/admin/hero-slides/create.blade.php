@extends('layouts.admin')

@section('page-title', 'Add Hero Slide')

@section('content')

<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.hero-slides.index') }}" class="admin-back-link">Back to list</a>
        <h2 class="admin-page-title">Add Hero Slide</h2>
        <p class="admin-page-subtitle">Create a homepage hero slider item</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i>
        Please check the form fields and try again.
    </div>
@endif

<form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data">
    @include('admin.hero-slides._form', ['heroSlide' => new \App\Models\HeroSlide()])

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-check"></i>
            Save Slide
        </button>
        <a href="{{ route('admin.hero-slides.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>

@endsection
