@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<style>
    .section-card {
        background: white;
        border-radius: 22px;
        box-shadow: 0 16px 36px rgba(128, 0, 32, .10);
        overflow: visible !important;
        margin-bottom: 24px;
        position: relative;
    }

    .about-cover {
        height: 170px;
        border-radius: 24px 24px 0 0;
        background: linear-gradient(135deg, #6A0019, #A52A4D 55%, #D98CA6);
        position: relative;
        overflow: hidden;
    }

    .about-cover::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 88% 15%, rgba(255,255,255,.25), transparent 45%),
            radial-gradient(circle at 10% 90%, rgba(255,255,255,.12), transparent 40%);
    }

    .section-head {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 22px 32px;
        border-bottom: 1px solid #F4E4EB;
    }

    .section-head .bi {
        color: #800020;
        font-size: 1.15rem;
    }

    .section-head h6 {
        margin: 0;
        color: #800020;
        font-weight: 700;
        font-size: 1rem;
    }

    /* ===== PROFIL ===== */
    .profile-body {
        padding: 0 32px 34px;
        margin-top: -58px;
        text-align: center;
        position: relative;
        z-index: 10;
    }

    .photo-wrap {
        width: 116px;
        height: 116px;
        border-radius: 50%;
        margin: 0 auto;
        padding: 5px;
        background: linear-gradient(135deg, #800020, #E8A5BC);
        box-shadow: 0 8px 20px rgba(128,0,32,.25);
        position: relative;
        z-index: 15;
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        object-position: center;
        border: 4px solid white;
        display: block;
        background: #F4C2D7;
    }

    .avatar-fallback {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 4px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #A52A4D, #800020);
        color: white;
        font-size: 2.1rem;
        font-weight: 700;
    }

    .about-name {
        color: #800020;
        font-weight: 700;
        margin-top: 16px;
        margin-bottom: 22px;
        font-size: 1.4rem;
    }

    /* ===== BIO ===== */
    .bio-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 380px;
        margin: 0 auto 24px;
    }

    .bio-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 18px;
        border-radius: 14px;
        background: #FFF8FA;
        border: 1px solid #F4E4EB;
        text-align: left;
    }

    .bio-row .k {
        color: #a06a7c;
        font-size: .75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .04em;
        white-space: nowrap;
    }

    .bio-row .v {
        color: #2d2d2d;
        font-weight: 700;
        font-size: .92rem;
        text-align: right;
    }

    /* ===== ALASAN PEMBUATAN APLIKASI ===== */
    .app-purpose-box {
        background: #FFF8FA;
        border: 1px solid #F4E4EB;
        border-radius: 16px;
        padding: 20px;
        max-width: 480px;
        margin: 0 auto;
        text-align: left;
    }

    .app-purpose-box h6 {
        color: #800020;
        font-weight: 700;
        font-size: .95rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .app-purpose-box p {
        color: #555;
        font-size: .88rem;
        line-height: 1.6;
        margin: 0;
    }

    /* ===== MEDIA SOSIAL ===== */
    .social-body {
        padding: 26px 32px 32px;
    }

    .social-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .social-btn {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        border-radius: 14px;
        background: #FFF8FA;
        border: 1.5px solid #F4C2D7;
        color: #800020;
        text-decoration: none;
        font-weight: 600;
        font-size: .93rem;
        transition: all .2s ease;
    }

    .social-btn:hover {
        background: linear-gradient(135deg, #800020, #A52A4D);
        color: white;
        border-color: #800020;
        transform: translateX(4px);
    }

    .social-btn .icon-box {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #F4C2D7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .social-btn:hover .icon-box {
        background: rgba(255,255,255,.2);
    }

    .social-btn .label small {
        display: block;
        font-weight: 400;
        font-size: .78rem;
        opacity: .75;
    }

    @media (max-width: 576px) {
        .profile-body, .social-body {
            padding-left: 22px;
            padding-right: 22px;
        }

        .bio-list, .app-purpose-box {
            max-width: 100%;
        }
    }
</style>

<div class="container mt-4" style="max-width: 700px;">

    {{-- ===== PROFIL ===== --}}
    <div class="section-card">
        <div class="about-cover"></div>

        <div class="profile-body">
            <div class="photo-wrap">
                @if(file_exists(public_path('images/sa.jpeg')))
                    <img src="{{ asset('images/sa.jpeg') }}" alt="Foto Profil" class="profile-photo">
                @else
                    <div class="avatar-fallback">SA</div>
                @endif
            </div>

            <h4 class="about-name">Sahla Amanda Kirani</h4>

            <div class="bio-list">
                <div class="bio-row">
                    <span class="k">Sekolah</span>
                    <span class="v">SMKN 4 Tasikmalaya</span>
                </div>
                <div class="bio-row">
                    <span class="k">Kelas</span>
                    <span class="v">XII</span>
                </div>
                <div class="bio-row">
                    <span class="k">Jurusan</span>
                    <span class="v">PPLG</span>
                </div>
            </div>

            {{-- ===== TENTANG / ALASAN PEMBUATAN APLIKASI ===== --}}
            <div class="app-purpose-box">
                <h6> Tujuan Pembuatan Aplikasi</h6>
                <p>
                    Aplikasi Point of Sale (POS) ini saya kembangkan dalam rangka mengikuti ujian Uji Kompetensi Keahlian (Ujikom) kelas XII jurusan PPLG SMKN 4 Tasikmalaya. Harapannya, sistem kasir ini dapat memberikan kemudahan dalam pengelolaan data produk, proses transaksi tunai, hingga rekap laporan penjualan.
                </p>
            </div>
        </div>
    </div>

    {{-- ===== MEDIA SOSIAL ===== --}}
    <div class="section-card" style="overflow: hidden !important;">
        <div class="section-head">
            <i class="bi bi-share-fill"></i>
            <h6>Media Sosial</h6>
        </div>

        <div class="social-body">
            <div class="social-list">
                <a href="https://wa.me/6283112863138" target="_blank" class="social-btn">
                    <span class="icon-box"><i class="bi bi-whatsapp"></i></span>
                    <span class="label">
                        WhatsApp
                        <small>Hubungi langsung lewat chat</small>
                    </span>
                </a>
                <a href="https://instagram.com/sahlaamnda" target="_blank" class="social-btn">
                    <span class="icon-box"><i class="bi bi-instagram"></i></span>
                    <span class="label">
                        Instagram
                        <small>@sahlaamnda</small>
                    </span>
                </a>
                <a href="https://github.com/sahlaamanda" target="_blank" class="social-btn">
                    <span class="icon-box"><i class="bi bi-github"></i></span>
                    <span class="label">
                        GitHub
                        <small>Lihat kode proyek</small>
                    </span>
                </a>
            </div>
        </div>
    </div>

</div>

@endsection