@extends('frontend.master')

@section('title', 'RTI - Ganga Devi Mahila Mahavidyalaya')

@section('content')
@include('frontend.partials.disclosure-page', [
    'pageTitle' => 'RTI',
    'pageSubtitle' => 'Right to Information documents, forms and public disclosures.',
    'badgeIcon' => 'bi-file-earmark-text-fill',
])
@endsection
