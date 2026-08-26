<style>
    .form-control, select.form-control{
        border-radius:12px;
        border:2px solid #F4C2D7;
    }

    .form-control:focus{
        border-color:#A52A4D;
        box-shadow:0 0 0 .2rem rgba(128,0,32,.15);
    }

    label{
        color:#800020;
        font-weight:600;
        margin-bottom:6px;
        display:inline-block;
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

<div class="mb-3">
    <label>Nama</label>
    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $user->name ?? '') }}">
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email"
           name="email"
           class="form-control"
           value="{{ old('email', $user->email ?? '') }}">
</div>

<div class="mb-3">
    <label>Password</label>
    <input type="password"
           name="password"
           class="form-control"
           placeholder="Kosongkan jika tidak ingin mengubah password">
</div>

<div class="mb-3">
    <label>Role</label>

    <select name="role_id" class="form-control">

        @foreach($roles as $role)
            <option value="{{ $role->id }}"
                @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                {{ $role->name }}
            </option>
        @endforeach

    </select>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-maroon">💾 Simpan</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-batal">Kembali</a>
</div>