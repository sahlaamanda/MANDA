<style>
    .form-control, .form-select{
        border-radius:12px;
        border:2px solid #F4C2D7;
    }

    .form-control:focus, .form-select:focus{
        border-color:#A52A4D;
        box-shadow:0 0 0 .2rem rgba(128,0,32,.15);
    }

    .form-label{
        color:#800020;
        font-weight:600;
    }

    .img-thumbnail{
        border:2px solid #F4C2D7;
        border-radius:15px;
    }

    .btn-maroon{
        background:#800020;
        color:white;
        border:none;
        border-radius:12px;
        padding:10px 18px;
    }

    .btn-maroon:hover{
        background:#A52A4D;
        color:white;
    }

    .btn-batal{
        background:#FFE4EC;
        color:#800020;
        border:none;
        border-radius:12px;
        padding:10px 18px;
    }

    .btn-batal:hover{
        background:#F4C2D7;
        color:#800020;
    }
</style>

{{-- FOTO SAAT INI --}}
@if (!empty($produk?->foto))
    <div class="mb-3">
        <label class="form-label">Foto Saat Ini</label>
        <br>

        <img
            src="{{ asset('storage/' . $produk->foto) }}"
            width="150"
            height="150"
            class="img-thumbnail"
            style="object-fit: cover;"
            alt="Foto {{ $produk->nama ?? 'Produk' }}"
        >
    </div>
@endif


{{-- FOTO PRODUK --}}
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">

            <label for="foto" class="form-label">
                Foto Produk
            </label>

            <input
                type="file"
                id="foto"
                name="foto"
                accept="image/jpeg,image/png,image/jpg,image/webp"
                onchange="previewImage(this)"
                class="form-control @error('foto') is-invalid @enderror"
            >

            <small class="text-muted">
                Format: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
            </small>

            @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>
    </div>


    {{-- PREVIEW FOTO --}}
    <div class="col-md-6">
        <div class="mb-3">

            <label class="form-label">
                Preview Foto
            </label>

            <br>

            <img
                id="preview"
                src="{{ !empty($produk?->foto) ? asset('storage/' . $produk->foto) : '' }}"
                class="img-thumbnail mt-2"
                width="150"
                height="150"
                alt="Preview Foto"
                style="
                    object-fit: cover;
                    {{ !empty($produk?->foto) ? '' : 'display:none;' }}
                "
            >

        </div>
    </div>
</div>


{{-- NAMA PRODUK --}}
<div class="mb-3">

    <label for="nama" class="form-label">
        Nama Produk
    </label>

    <input
        type="text"
        id="nama"
        name="nama"
        class="form-control @error('nama') is-invalid @enderror"
        value="{{ old('nama', $produk?->nama ?? '') }}"
        placeholder="Masukkan nama produk"
        required
    >

    @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- JENIS PRODUK --}}
<div class="mb-3">

    <label for="jenis_id" class="form-label">
        Jenis Produk
    </label>

    <select
        id="jenis_id"
        name="jenis_id"
        class="form-select @error('jenis_id') is-invalid @enderror"
        required
    >

        <option value="">
            -- Pilih Jenis Produk --
        </option>

        @forelse ($jenis as $j)

            <option
                value="{{ $j->id }}"
                {{ old('jenis_id', $produk?->jenis_id) == $j->id ? 'selected' : '' }}
            >
                {{ $j->nama }}
            </option>

        @empty

            <option value="" disabled>
                Belum ada jenis produk
            </option>

        @endforelse

    </select>

    @error('jenis_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- HARGA POKOK --}}
<div class="mb-3">

    <label for="harga_beli" class="form-label">
        Harga Pokok
    </label>

    <input
        type="number"
        id="harga_beli"
        name="harga_beli"
        class="form-control @error('harga_beli') is-invalid @enderror"
        value="{{ old('harga_beli', $produk?->harga_beli ?? '') }}"
        min="0"
        placeholder="Masukkan harga pokok"
        required
    >

    @error('harga_beli')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- LABA --}}
<div class="mb-3">

    <label for="laba" class="form-label">
        Laba
    </label>

    <input
        type="text"
        id="laba"
        class="form-control"
        value="30%"
        readonly
    >

</div>


{{-- HARGA JUAL --}}
<div class="mb-3">

    <label for="harga_jual" class="form-label">
        Harga Jual
    </label>

    <input
        type="number"
        id="harga_jual"
        name="harga_jual"
        class="form-control @error('harga_jual') is-invalid @enderror"
        value="{{ old('harga_jual', $produk?->harga_jual ?? '') }}"
        min="0"
        placeholder="Otomatis dari harga pokok"
        required
        readonly
    >

    @error('harga_jual')
        <div class="invalid-feedback"> {{ $message }} </div>
        <div class=
    @enderror

</div>

{{-- STOK --}}
<div class="mb-3">

    <label for="stok" class="form-label">
        Stok
    </label>

    <input
        type="number"
        id="stok"
        name="stok"
        class="form-control @error('stok') is-invalid @enderror"
        value="{{ old('stok', $produk?->stok ?? '') }}"
        min="0"
        placeholder="Masukkan jumlah stok"
        required
    >

    @error('stok')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- TOMBOL --}}
<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-maroon">💾 Simpan</button>
    <a href="{{ route('admin.produk.index') }}" class="btn btn-batal">Batal</a>
</div>


{{-- JAVASCRIPT PREVIEW --}}
<script>
const hargaBeliInput = document.getElementById('harga_beli');
const hargaJualInput = document.getElementById('harga_jual');

function hitungHargaJual() {
    const hargaBeli = Number(hargaBeliInput.value);

    hargaJualInput.value = Number.isFinite(hargaBeli) && hargaBeli >= 0
        ? Math.round(hargaBeli * 1.3)
        : '';
}

hargaBeliInput.addEventListener('input', hitungHargaJual);
hitungHargaJual();

function previewImage(input) {

    const preview = document.getElementById('preview');

    if (!input.files || !input.files[0]) {
        return;
    }

    const file = input.files[0];

    if (file.size > 2 * 1024 * 1024) {

        alert('Ukuran foto maksimal 2 MB.');

        input.value = '';
        preview.src = '';
        preview.style.display = 'none';

        return;
    }

    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/jpg',
        'image/webp'
    ];

    if (!allowedTypes.includes(file.type)) {

        alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');

        input.value = '';
        preview.src = '';
        preview.style.display = 'none';

        return;
    }

    const reader = new FileReader();

    reader.onload = function(event) {

        preview.src = event.target.result;
        preview.style.display = 'inline-block';

    };

    reader.readAsDataURL(file);
}
</script>