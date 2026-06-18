@extends('layouts.admin')

@section('page-title', 'Edit Disclosure Document')

@section('content')
<div class="admin-page-head">
    <div>
        <a href="{{ route('admin.disclosure-documents.index') }}" class="admin-back-link">Back to list</a>
        <h2 class="admin-page-title">Edit Disclosure Document</h2>
        <p class="admin-page-subtitle">Update RTI or NAAC/IQAC document</p>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Please check the form fields and try again.</div>
@endif

<form method="POST" action="{{ route('admin.disclosure-documents.update', $disclosureDocument) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.disclosure-documents._form')
    <div class="form-actions">
        <button type="submit" class="btn-primary"><i class="fas fa-check"></i> Update Document</button>
        <a href="{{ route('admin.disclosure-documents.index') }}" class="btn-ghost">Cancel</a>
    </div>
</form>
@endsection
