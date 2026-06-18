@extends('frontend.master')

@section('title', 'NAAC / IQAC - Ganga Devi Mahila Mahavidyalaya')

@section('content')
@include('frontend.partials.disclosure-page', [
    'pageTitle' => 'NAAC / IQAC',
    'pageSubtitle' => 'Accreditation, IQAC, AQAR, SSR, DVV and quality assurance documents.',
    'badgeIcon' => 'bi-shield-check',
])
@endsection
