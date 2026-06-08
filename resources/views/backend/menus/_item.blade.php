<div class="dd-handle d-flex justify-content-between align-items-center">
    {{ $node->label }}
    <button class="btn btn-secondary btn-sm dd-nodrag" type="button"
        data-bs-toggle="collapse" data-bs-target="#collapse{{ $node->id }}"
        aria-expanded="false" aria-controls="collapse{{ $node->id }}">
        <i class="fas fa-chevron-down"></i>
    </button>
</div>

<div id="collapse{{ $node->id }}" class="collapse">
    <div class="p-3 border mt-2">
        <form action="{{ route('menus.update', $node->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group mb-2">
                <label class="form-label">Label</label>
                <input type="text" name="label" class="form-control"
                    value="{{ $node->label }}" required>
            </div>

            <div class="form-group mb-2">
                <label class="form-label">URL</label>
                <input type="text" name="url" class="form-control"
                    value="{{ $node->url }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Page (optional)</label>
                <select name="page_id" class="form-select">
                    <option value="">-- Select Page --</option>
                    @foreach ($pages as $page)
                        <option value="{{ $page->id }}"
                            {{ $node->page_id == $page->id ? 'selected' : '' }}>
                            {{ $page->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-success">Save Changes</button>
                <button type="button" class="btn btn-sm btn-danger"
                    onclick="konfirmasiHapus('{{ $node->id }}')">Delete</button>
            </div>
        </form>
    </div>
</div>
