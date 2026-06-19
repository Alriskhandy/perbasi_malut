<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Provinsi</label>
        <select name="province" id="provinceSelect" class="form-select @error('province') is-invalid @enderror">
            <option value="">-- Memuat Provinsi... --</option>
        </select>
        @error('province') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Kab / Kota</label>
        <select name="city" id="citySelect" class="form-select @error('city') is-invalid @enderror">
            <option value="">-- Pilih Kab/Kota --</option>
        </select>
        @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
