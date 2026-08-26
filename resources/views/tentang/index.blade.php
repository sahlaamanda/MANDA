@extends('layouts.app')

@section('title', 'Tentang')

@section('content')

<style>
    .about-cover {
        height: 190px;
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

    .about-cover::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        border: 1.5px solid rgba(255,255,255,.18);
        top: -60px;
        right: -40px;
    }

    .about-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 45px rgba(128, 0, 32, .12);
        overflow: hidden;
        margin-bottom: 25px;
    }

    .about-body {
        padding: 0 40px 40px;
        margin-top: -70px;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .photo-wrap {
        width: 132px;
        height: 132px;
        border-radius: 50%;
        margin: 0 auto;
        padding: 5px;
        background: linear-gradient(135deg, #800020, #E8A5BC);
        box-shadow: 0 8px 20px rgba(128,0,32,.25);
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
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
        font-size: 2.4rem;
        font-weight: 700;
    }

    .about-name {
        color: #800020;
        font-weight: 700;
        margin-top: 18px;
        margin-bottom: 3px;
        font-size: 1.5rem;
    }

    .about-role {
        color: #6c757d;
        font-size: .92rem;
        margin-bottom: 18px;
    }

    .about-role .bi {
        color: #A52A4D;
    }

    .pill-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
    }

    .info-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 16px;
        border-radius: 30px;
        background: #FFF8FA;
        border: 1.5px solid #F4C2D7;
        color: #800020;
        font-size: .85rem;
        font-weight: 600;
        transition: all .2s ease;
    }

    .info-pill:hover {
        background: #800020;
        color: white;
        border-color: #800020;
    }

    .about-desc {
        color: #4a4a4a;
        line-height: 1.8;
        margin-top: 22px;
        text-align: left;
        font-size: .96rem;
    }

    .contact-row {
        margin-top: 26px;
        padding-top: 24px;
        border-top: 1px solid #F4E4EB;
    }

    .contact-title {
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: #A52A4D;
        font-weight: 700;
        margin-bottom: 14px;
        text-align: left;
    }

    .contact-btns {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .contact-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 11px 20px;
        border-radius: 12px;
        background: #FFF8FA;
        border: 2px solid #F4C2D7;
        color: #800020;
        text-decoration: none;
        font-weight: 600;
        font-size: .9rem;
        transition: all .2s ease;
    }

    .contact-btn:hover {
        background: linear-gradient(135deg, #800020, #A52A4D);
        color: white;
        border-color: #800020;
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(128,0,32,.25);
    }

    .contact-btn .bi {
        font-size: 1.05rem;
    }

    .project-card {
        background: white;
        border-radius: 20px;
        padding: 28px 30px;
        box-shadow: 0 10px 25px rgba(128, 0, 32, .08);
    }

    .project-card h6 {
        color: #800020;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .project-card .bi {
        color: #A52A4D;
    }

    .project-item {
        padding: 14px;
        border-radius: 14px;
        background: #FFF8FA;
        border: 1px solid #F4E4EB;
        height: 100%;
    }

    @media (min-width: 576px) {
        .contact-title, .about-desc { text-align: center; }
    }
</style>

<div class="container mt-4" style="max-width: 780px;">

    <div class="about-card">
        <div class="about-cover"></div>

        <div class="about-body">
            <div class="photo-wrap">
                @if(file_exists(public_path('images/gggg.png')))
                    <img src="{{ asset('images/gggg.png') }}" alt="Foto Profil" class="profile-photo">
                @else
                    <div class="avatar-fallback">SA</div>
                @endif
            </div>

            <h4 class="about-name">Sahla Amanda Kirani</h4>
            <div class="about-role">
                <i class="bi bi-mortarboard-fill me-1"></i>
                SMKN 4 Tasikmalaya
            </div>

            <div class="pill-row">
                <span class="info-pill"><i class="bi bi-people-fill"></i> Kelas XII PPLG 4</span>
                <span class="info-pill"><i class="bi bi-award-fill"></i> Persiapan UKK</span>
            </div>

            <p class="about-desc">
                Aplikasi Point of Sale (POS) ini saya kembangkan sebagai bagian dari
                persiapan Uji Kompetensi Keahlian (UKK) sekolah. Melalui proyek ini,
                saya berusaha menerapkan konsep pemrograman web menggunakan Laravel
                secara utuh — mulai dari perancangan basis data, alur autentikasi,
                hingga manajemen data produk dan transaksi penjualan. Semoga aplikasi
                ini dapat menjadi bukti proses belajar sekaligus langkah awal untuk
                terus berkembang di dunia pengembangan perangkat lunak.
            </p>

            <div class="contact-row">
                <div class="contact-title">Hubungi saya</div>

                <div class="contact-btns">
                    <a href="https://wa.me/6283112863138" target="_blank" class="contact-btn">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://instagram.com/sahlaamnda" target="_blank" class="contact-btn">
                        <i class="bi bi-instagram"></i> Instagram
                    </a>
                    <a href="https://github.com/sahlaamanda" target="_blank" class="contact-btn">
                        <i class="bi bi-github"></i> GitHub
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="project-card">
        <h6><i class="bi bi-box-seam me-2"></i>Tentang Proyek</h6>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="project-item">
                    <small class="text-muted d-block">Aplikasi</small>
                    <strong>POS - Point of Sale</strong>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="project-item">
                    <small class="text-muted d-block">Versi</small>
                    <strong>1.0.0</strong>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="project-item">
                    <small class="text-muted d-block">Framework</small>
                    <strong>Laravel {{ app()->version() }}</strong>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="project-item">
                    <small class="text-muted d-block">PHP</small>
                    <strong>{{ phpversion() }}</strong>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection