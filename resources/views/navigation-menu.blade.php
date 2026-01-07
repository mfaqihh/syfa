<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">SYFA</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link" wire:navigate.hover>
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Peminjaman Dana -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Apps & Pages">Peminjaman Dana</span>
        </li>

        <li class="menu-item {{ request()->routeIs('peminjaman-dana') ? 'active' : '' }}">
            <a href="{{ route('peminjaman-dana') }}" class="menu-link" wire:navigate.hover>
                <i class="menu-icon tf-icons ti ti-wallet"></i>
                <div data-i18n="Peminjaman Dana">Peminjaman Dana</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('ar-perbulan') ? 'active' : '' }}">
            <a href="{{ route('ar-perbulan') }}" class="menu-link" wire:navigate.hover>
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div data-i18n="Ar Perbulan">Ar Perbulan</div>
            </a>
        </li>

        <!-- Master Data -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Apps & Pages">Master Data</span>
        </li>

        <li class="menu-item {{ request()->routeIs('master-data.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-database"></i>
                <div data-i18n="Master Data">Master Data</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item {{ request()->routeIs('master-data.sumber-pendanaan-eksternal') ? 'active' : '' }}">
                    <a href="{{ route('master-data.sumber-pendanaan-eksternal') }}" class="menu-link"
                        wire:navigate.hover>
                        <div data-i18n="Sumber Pendanaan Eksternal">Sumber Pendanaan Eksternal</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('master-data.kol-configuration') ? 'active' : '' }}">
                    <a href="{{ route('master-data.kol-configuration') }}" class="menu-link" wire:navigate.hover>
                        <div data-i18n="Kol Configuration">Kol Configuration</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('master-data.debitur-dan-investor') ? 'active' : '' }}">
                    <a href="{{ route('master-data.debitur-dan-investor') }}" class="menu-link" wire:navigate.hover>
                        <div data-i18n="Debitur Dan Investor">Debitur Dan Investor</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('master-data.cells-project') ? 'active' : '' }}">
                    <a href="{{ route('master-data.cells-project') }}" class="menu-link" wire:navigate.hover>
                        <div data-i18n="Cells Project">Cells Project</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Apps & Pages">Access Control</span>
        </li>

        <li class="menu-item {{ request()->routeIs('access-control.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-lock"></i>
                <div data-i18n="Access Control">Access Control</div>
            </a>
            <ul class="menu-sub">
  
            </ul>
        </li>
    </ul>
</aside>
