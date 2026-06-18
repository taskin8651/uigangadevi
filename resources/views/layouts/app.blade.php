<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@php
    $websiteSetting = \App\Models\WebsiteSetting::current();
    $siteName = $websiteSetting->site_name ?: trans('panel.site_title');
    $siteTagline = $websiteSetting->site_tagline ?: 'Official College Website';
    $siteLogo = $websiteSetting->logo ?: asset('assets/img/logo.png');
    $siteFavicon = $websiteSetting->favicon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $siteName)</title>

    @if($siteFavicon)
        <link rel="icon" href="{{ $siteFavicon }}">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #173f73;
            --primary-dark: #0d2d55;
            --secondary: #b51f2a;
            --accent: #f4b400;
            --text: #5f6b7a;
            --border: #dce5f0;
            --light-bg: #f5f8fc;
            --shadow-lg: 0 28px 75px rgba(13, 45, 85, 0.14);
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: "Inter", sans-serif;
            color: #172334;
            background:
                radial-gradient(circle at 12% 15%, rgba(244, 180, 0, 0.22), transparent 26%),
                radial-gradient(circle at 90% 12%, rgba(181, 31, 42, 0.14), transparent 27%),
                linear-gradient(135deg, #eef4fb 0%, #ffffff 45%, #f8fafc 100%);
        }

        a {
            text-decoration: none;
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(380px, 470px);
        }

        .auth-brand-panel {
            position: relative;
            min-height: 100%;
            padding: 48px;
            display: flex;
            align-items: center;
            overflow: hidden;
            color: #ffffff;
            background:
                linear-gradient(135deg, rgba(13, 45, 85, 0.9), rgba(23, 63, 115, 0.76)),
                url("{{ asset('assets/img/hero.png') }}") center / cover no-repeat;
        }

        .auth-brand-panel::after {
            content: "";
            position: absolute;
            inset: auto 0 0;
            height: 7px;
            background: linear-gradient(90deg, var(--secondary), var(--accent), var(--primary));
        }

        .auth-brand-content {
            position: relative;
            max-width: 650px;
        }

        .auth-logo-row {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 34px;
        }

        .auth-logo-row img {
            width: 72px;
            height: 72px;
            object-fit: contain;
            border-radius: 16px;
            background: #ffffff;
            padding: 8px;
            box-shadow: 0 18px 44px rgba(0, 0, 0, 0.18);
        }

        .auth-logo-row h1 {
            margin: 0;
            font-size: 26px;
            line-height: 1.18;
            font-weight: 900;
        }

        .auth-logo-row span {
            display: block;
            margin-top: 4px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 14px;
            font-weight: 700;
        }

        .auth-brand-content h2 {
            max-width: 720px;
            margin: 0 0 16px;
            font-size: 46px;
            line-height: 1.07;
            font-weight: 950;
        }

        .auth-brand-content p {
            max-width: 620px;
            margin: 0;
            color: rgba(255, 255, 255, 0.82);
            font-size: 16px;
            line-height: 1.75;
            font-weight: 500;
        }

        .auth-feature-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .auth-feature-row span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 13px;
            border-radius: 999px;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.13);
            border: 1px solid rgba(255, 255, 255, 0.18);
            font-size: 13px;
            font-weight: 800;
        }

        .auth-form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 34px;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(220, 229, 240, 0.96);
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            padding: 30px;
        }

        .auth-card-head {
            margin-bottom: 22px;
        }

        .auth-card-head span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            border-radius: 999px;
            background: #eaf1fa;
            color: var(--primary);
            font-size: 12px;
            font-weight: 900;
        }

        .auth-card-head h2 {
            margin: 14px 0 7px;
            color: var(--primary-dark);
            font-size: 30px;
            line-height: 1.15;
            font-weight: 950;
        }

        .auth-card-head p {
            margin: 0;
            color: var(--text);
            font-size: 14px;
            line-height: 1.6;
        }

        .auth-alert {
            padding: 12px 14px;
            margin-bottom: 16px;
            border-radius: 12px;
            color: #1d4ed8;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            font-size: 13px;
            font-weight: 700;
        }

        .auth-form {
            display: grid;
            gap: 16px;
        }

        .auth-field label {
            display: block;
            margin-bottom: 7px;
            color: #253348;
            font-size: 13px;
            font-weight: 850;
        }

        .auth-input-wrap {
            position: relative;
        }

        .auth-input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 15px;
        }

        .auth-input {
            width: 100%;
            height: 48px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: #ffffff;
            color: #172334;
            padding: 0 14px 0 42px;
            font-size: 14px;
            font-weight: 650;
            outline: none;
            transition: all 0.22s ease;
        }

        .auth-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(23, 63, 115, 0.11);
        }

        .auth-input.error {
            border-color: #dc2626;
        }

        .auth-error {
            margin: 6px 0 0;
            color: #dc2626;
            font-size: 12px;
            font-weight: 700;
        }

        .auth-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            font-size: 13px;
        }

        .auth-check {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text);
            font-weight: 700;
        }

        .auth-link {
            color: var(--secondary);
            font-weight: 850;
        }

        .auth-button {
            width: 100%;
            min-height: 48px;
            border: 0;
            border-radius: 999px;
            color: #ffffff;
            background: linear-gradient(135deg, var(--secondary), #d13d48);
            box-shadow: 0 15px 30px rgba(181, 31, 42, 0.24);
            font-size: 14px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .auth-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 38px rgba(181, 31, 42, 0.3);
        }

        .auth-bottom {
            padding-top: 5px;
            text-align: center;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .auth-back-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 18px;
            color: var(--primary);
            font-size: 13px;
            font-weight: 850;
        }

        @media (max-width: 980px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }

            .auth-brand-panel {
                min-height: auto;
                padding: 30px 22px;
            }

            .auth-brand-content h2 {
                font-size: 34px;
            }

            .auth-form-panel {
                padding: 24px 16px 34px;
            }
        }

        @media (max-width: 560px) {
            .auth-logo-row {
                align-items: flex-start;
            }

            .auth-logo-row img {
                width: 56px;
                height: 56px;
            }

            .auth-logo-row h1 {
                font-size: 19px;
            }

            .auth-brand-content h2 {
                font-size: 28px;
            }

            .auth-card {
                padding: 22px;
                border-radius: 18px;
            }

            .auth-row {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    <main class="auth-shell">
        <section class="auth-brand-panel">
            <div class="auth-brand-content">
                <div class="auth-logo-row">
                    <img src="{{ $siteLogo }}" alt="{{ $siteName }}">
                    <div>
                        <h1>{{ $siteName }}</h1>
                        <span>{{ $siteTagline }}</span>
                    </div>
                </div>

                <h2>Secure access to college administration.</h2>
                <p>
                    Manage official college content, notices, academics, gallery,
                    disclosures and website settings from one protected dashboard.
                </p>

                <div class="auth-feature-row">
                    <span><i class="bi bi-shield-check"></i> Protected Login</span>
                    <span><i class="bi bi-megaphone-fill"></i> Dynamic Website</span>
                    <span><i class="bi bi-file-earmark-text-fill"></i> Official Records</span>
                </div>
            </div>
        </section>

        <section class="auth-form-panel">
            @yield('content')
        </section>
    </main>

    @yield('scripts')
</body>
</html>
