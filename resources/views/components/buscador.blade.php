<div class="row">
    <div class="col-md-8 col-lg-6">
        <form
            action="{{ $action }}"
            method="GET"
            class="mb-5 p-4 border border-secondary rounded"
        >
            <h2 class="h4 text-warning mb-4">
                {{ $titulo }}
            </h2>

            <div class="mb-3">
                <label for="{{ $id }}" class="form-label text-light">
                    {{ $label }}
                </label>

                <input
                    type="search"
                    id="{{ $id }}"
                    name="{{ $name }}"
                    value="{{ $value }}"
                    class="form-control"
                >
            </div>

            <button type="submit" class="btn btn-vhs-cyan fw-bold">
                {{ $button }}
            </button>
        </form>
    </div>
</div>