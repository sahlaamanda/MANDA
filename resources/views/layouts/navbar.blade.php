<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">

    {{-- LOGO + NAMA POS --}}
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
      <img src="{{ asset('images/logo_sahla.png') }}" alt="Logo POS" height="100" class="d-inline-block align-text-top">
      <span>POS</span>
    </a>

    <button class="navbar-toggler" type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        {{-- DASHBOARD --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
             href="{{ route('dashboard') }}">
             Dashboard
          </a>
        </li>

        {{-- USERS (HANYA UNTUK ADMIN) --}}
        @if(auth()->user()->role?->name === 'admin')
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}"
             href="{{ route('admin.users.index') }}">
             Users
          </a>
        </li>
        @endif

        {{-- JENIS PRODUK --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/jenis*') ? 'active' : '' }}"
             href="{{ route('admin.jenis.index') }}">
             Jenis
          </a>
        </li>

        {{-- PRODUK --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/produk*') ? 'active' : '' }}"
             href="{{ route('admin.produk.index') }}">
             Produk
          </a>
        </li>

        {{-- PENJUALAN --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/penjualan*') ? 'active' : '' }}"
             href="{{ route('admin.penjualan.index') }}">
             Penjualan
          </a>
        </li>



        {{-- PROFILE--}}
<li class="nav-item">
  <a class="nav-link {{ Request::is('admin/profile*') ? 'active' : '' }}"
     href="{{ route('admin.profile') }}">
     Profile
  </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.about') }}" class="nav-link {{ request()->routeIs('admin.about') ? 'active' : '' }}">
        <span>Tentang Aplikasi</span>
    </a>
</li>

      </ul>

      {{-- LOGOUT (Form tersembunyi agar tidak bentrok dengan form lain) --}}
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
      <button type="button" class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">
        Logout
      </button>

    </div>
  </div>
</nav>