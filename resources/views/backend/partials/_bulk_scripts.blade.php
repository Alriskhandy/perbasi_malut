<script>
(function () {
    var form      = document.getElementById('{{ $formId }}');
    var selectAll = form.querySelector('.select-all-cb');
    var applyBtn  = form.querySelector('.btn-apply-bulk');

    // Select all checkbox
    selectAll.addEventListener('change', function () {
        form.querySelectorAll('input[name="selected_ids[]"]').forEach(function (cb) {
            cb.checked = selectAll.checked;
        });
    });

    // Apply bulk action
    applyBtn.addEventListener('click', function () {
        var action = form.querySelector('[name="action"]').value;
        var checked = form.querySelectorAll('input[name="selected_ids[]"]:checked');

        if (!action) {
            Swal.fire({ title: 'Pilih Tindakan', text: 'Pilih tindakan bulk terlebih dahulu.', icon: 'info', confirmButtonColor: '#3085d6' });
            return;
        }
        if (checked.length === 0) {
            Swal.fire({ title: 'Tidak Ada Pilihan', text: 'Centang setidaknya satu data.', icon: 'warning', confirmButtonColor: '#3085d6' });
            return;
        }

        if (action === 'hapus') {
            Swal.fire({
                title: 'Hapus {{ $entity }}?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) form.submit();
            });
        } else {
            form.submit();
        }
    });
})();
</script>
