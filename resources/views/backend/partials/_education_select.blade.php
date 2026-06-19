@php $eduValue = old('education', $selectedEducation ?? ''); @endphp
<select name="education" class="form-select @error('education') is-invalid @enderror">
    <option value="">-- Pilih Pendidikan --</option>
    <option value="SD" {{ $eduValue == 'SD' ? 'selected' : '' }}>SD</option>
    <option value="SMP" {{ $eduValue == 'SMP' ? 'selected' : '' }}>SMP</option>
    <option value="SMA" {{ $eduValue == 'SMA' ? 'selected' : '' }}>SMA</option>
    <option value="DIPLOMA" {{ $eduValue == 'DIPLOMA' ? 'selected' : '' }}>Diploma</option>
    <option value="S1" {{ $eduValue == 'S1' ? 'selected' : '' }}>S1</option>
    <option value="S2" {{ $eduValue == 'S2' ? 'selected' : '' }}>S2</option>
    <option value="S3" {{ $eduValue == 'S3' ? 'selected' : '' }}>S3</option>
</select>
@error('education') <div class="invalid-feedback">{{ $message }}</div> @enderror
