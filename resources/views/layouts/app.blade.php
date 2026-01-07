<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template-no-customizer" data-style="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SYFA') }}</title>

    <meta name="description" content="SYFA - Sistem Aplikasi" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" /> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" /> -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

    <!-- Page CSS -->
    @stack('page-css')

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Adds the Core Table Styles -->
    @rappasoftTableStyles

    <!-- Adds any relevant Third-Party Styles (Used for DateRangeFilter (Flatpickr) and NumberRangeFilter) -->
    @rappasoftTableThirdPartyStyles

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu - Persisted across navigation -->
            @persist('navigation-menu')
                @livewire('navigation-menu')
            @endpersist
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar - Persisted across navigation -->
                @persist('navigation-bar')
                    @include('navigation-bar')
                @endpersist
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{ $slot }}
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    © {{ date('Y') }}, made with ❤️ by
                                    <a href="#" target="_blank" class="footer-link">SYFA Team</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="#" target="_blank" class="footer-link me-4">Documentation</a>
                                    <a href="#" target="_blank" class="footer-link">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay - Persisted -->
        @persist('layout-overlay')
            <div class="layout-overlay layout-menu-toggle"></div>
        @endpersist

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        @persist('drag-target')
            <div class="drag-target"></div>
        @endpersist
    </div>
    <!-- / Layout wrapper -->

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="liveToast" class="toast align-items-center text-white border-0 bg-success" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="ti ti-check ti-lg me-2"></i>
                    <span>Pesan notifikasi</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts

    <!-- Adds the Core Table Scripts -->
    @rappasoftTableScripts

    <!-- Adds any relevant Third-Party Scripts (e.g. Flatpickr) -->
    @rappasoftTableThirdPartyScripts

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    @stack('vendor-js')

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    @stack('page-js')

    <!-- Livewire Navigate - Update Active Menu State -->
    <script>
        // Update active menu state after navigation
        function updateActiveMenuState() {
            const layoutMenu = document.getElementById('layout-menu');
            if (!layoutMenu) return;

            const currentUrl = window.location.href;
            const menuLinks = layoutMenu.querySelectorAll('.menu-link');

            // Remove all active and open states
            layoutMenu.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active', 'open');
            });

            // Set active state based on current URL
            menuLinks.forEach(link => {
                if (link.href === currentUrl) {
                    const menuItem = link.closest('.menu-item');
                    if (menuItem) {
                        menuItem.classList.add('active');

                        // Open parent menus
                        let parent = menuItem.parentElement;
                        while (parent) {
                            if (parent.classList.contains('menu-item')) {
                                parent.classList.add('active', 'open');
                            }
                            parent = parent.parentElement;
                        }
                    }
                }
            });
        }

        // Listen for Livewire navigation
        document.addEventListener('livewire:navigated', () => {
            updateActiveMenuState();
        });

        // Listen for Toast events from Livewire
        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', (data) => {
                showToast(data[0].type || data.type, data[0].message || data.message);
            });
        });

        // Toast function
        function showToast(type, message) {
            const toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) return;

            const toastEl = document.getElementById('liveToast');
            if (toastEl) {
                // Update toast content
                const toastBody = toastEl.querySelector('.toast-body span');
                const toastIcon = toastEl.querySelector('.toast-body i');

                if (toastBody) toastBody.textContent = message;

                // Update icon based on type
                const iconMap = {
                    'success': 'ti-check',
                    'danger': 'ti-x',
                    'warning': 'ti-alert-triangle',
                    'info': 'ti-info-circle'
                };

                if (toastIcon) {
                    toastIcon.className = `ti ${iconMap[type] || 'ti-check'} ti-lg me-2`;
                }

                // Update background color
                toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');
                toastEl.classList.add(`bg-${type}`);

                // Show toast using Bootstrap
                const bsToast = new bootstrap.Toast(toastEl, {
                    delay: 4000
                });
                bsToast.show();
            }
        }

        // Modal helper functions
        function openModalById(modalId) {
            const modalEl = document.getElementById(modalId);
            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }
        }

        function closeModalById(modalId) {
            const modalEl = document.getElementById(modalId);
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
            }
        }

        // Listen for modal events from Livewire (global)
        document.addEventListener('livewire:init', () => {
            Livewire.on('openModalById', (data) => {
                openModalById(data.modalId || data[0]?.modalId);
            });

            Livewire.on('closeModalById', (data) => {
                closeModalById(data.modalId || data[0]?.modalId);
            });
        });
    </script>
</body>

</html>
