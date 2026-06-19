<script>
(function() {
    var provinceSelect = document.getElementById('provinceSelect');
    var citySelect = document.getElementById('citySelect');
    var oldProvince = @json(old('province', $selectedProvince ?? ''));
    var oldCity = @json(old('city', $selectedCity ?? ''));
    var defaultProvince = 'MALUKU UTARA';

    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
        .then(function(r) { return r.json(); })
        .then(function(provinces) {
            provinceSelect.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
            provinces.forEach(function(p) {
                var opt = document.createElement('option');
                opt.value = p.name;
                opt.textContent = p.name;
                opt.dataset.id = p.id;
                provinceSelect.appendChild(opt);
            });
            provinceSelect.value = oldProvince || defaultProvince;
            provinceSelect.dispatchEvent(new Event('change'));
        });

    provinceSelect.addEventListener('change', function() {
        citySelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
        var selected = provinceSelect.selectedOptions[0];
        if (!selected || !selected.dataset.id) return;

        citySelect.innerHTML = '<option value="">-- Memuat... --</option>';
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + selected.dataset.id + '.json')
            .then(function(r) { return r.json(); })
            .then(function(cities) {
                citySelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
                cities.forEach(function(c) {
                    var opt = document.createElement('option');
                    opt.value = c.name;
                    opt.textContent = c.name;
                    citySelect.appendChild(opt);
                });
                if (oldCity) citySelect.value = oldCity;
            });
    });
})();
</script>
