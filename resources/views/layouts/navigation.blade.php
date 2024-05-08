<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.index', ['locale' => app()->getLocale()]) }}">
            <i class="nav-icon fas fa-solid fa-house"></i>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('reimbursement.index', ['locale' => app()->getLocale()]) }}">
            <i class="nav-icon fa-solid fa-money-bill-1-wave"></i>
            {{ __('Reimburs') }}
        </a>
    </li>

    @if (Auth::user() && Auth::user()->hasRole('director'))
        <li class="nav-group" aria-expanded="false">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="nav-icon fas fa-cog"></i>
                Pengaturan
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('setting-admin.index', ['locale' => app()->getLocale()]) }}">
                        {{ __('Pengaturan Peran') }}
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>
