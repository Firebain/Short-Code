<form method="POST" action="{{ route("store") }}">
    @csrf

    <input type="hidden" name="page_uid" value="{{ $page_uid }}">

    <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                value="{{ old('title') }}">

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Body') }}</label>

        <div class="col-md-6">
            <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror"
                name="body">{{ old('title') }}</textarea>

            @error('body')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Add') }}
            </button>
        </div>
    </div>
</form>

@foreach ($rows as $row)
<div class="row no-gutters border rounded overflow-hidden flex-md-row mt-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-static">
        <h3 class="mb-0">{{ $row["title"] }}</h3>
        <p class="card-text mb-auto">{{ $row["body"] }}</p>
    </div>
</div>
@endforeach
