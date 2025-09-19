<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head-scripts')

        <!-- Styles -->
        @livewireStyles

        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            }

            .dashboard-container {
                min-height: 100vh;
                background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            }

            /* Header Styles */
            .dashboard-header {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(102, 126, 234, 0.1);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }

            .header-content {
                background: linear-gradient(45deg, #667eea, #764ba2);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: bold;
            }

            /* Main Content Area */
            .main-content {
                padding: 2rem 0;
            }

            .content-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                overflow: hidden;
                position: relative;
            }

            .content-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(45deg, #667eea, #764ba2);
            }

            /* Navigation Enhancement */
            .nav-enhancement {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid rgba(102, 126, 234, 0.1);
            }

            /* Animation */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeInUp 0.6s ease-out;
            }

            /* Dark mode adjustments */
            .dark .dashboard-container {
                background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            }

            .dark .dashboard-header {
                background: rgba(26, 32, 44, 0.95);
                border-bottom-color: rgba(102, 126, 234, 0.2);
            }

            .dark .content-card {
                background: rgba(26, 32, 44, 0.95);
                border-color: rgba(255, 255, 255, 0.1);
            }

            /* Responsive */
            @media (max-width: 768px) {
                .main-content {
                    padding: 1rem 0;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <x-imports.sweetalert2 />

        <div class="dashboard-container">
            <!-- Enhanced Navigation -->
            <div class="nav-enhancement">
                @livewire('navigation-menu')
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="dashboard-header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="header-content">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="main-content animate-fade-in">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
    @stack('foot-scripts')
</html>
