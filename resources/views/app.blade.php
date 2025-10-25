<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Primary Meta Tags --}}
        <meta name="title" content="{{ config('app.name', 'MyApp') }}">
        <meta name="description" content="Earn rewards, track investments, and grow your network with {{ config('app.name', 'MyApp') }} — a next-generation platform for referral-based income and financial empowerment.">
        <meta name="keywords" content="{{ config('app.name', 'MyApp') }} Rewards App, Investment Platform, Referral System, Wallet, CTO Royalty, Thailand Tour, Dubai Tour">
        <meta name="author" content="MyApp Team" />
        <meta name="robots" content="index, follow" />

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{asset('assets/images/wdp-logo.png')}}" sizes="any">
        <link rel="icon" href="{{asset('assets/images/wdp-logo.png')}}" type="image/svg+xml">
        <link rel="apple-touch-icon" href="{{asset('assets/images/wdp-logo.png')}}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
