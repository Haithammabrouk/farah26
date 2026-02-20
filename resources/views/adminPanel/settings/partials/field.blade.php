<div class="form-group">
    <label for="{{ $setting->key }}" class="font-weight-bold">
        {{ $setting->label }}
        @if($setting->description)
            <i class="fas fa-info-circle text-muted ml-1"
               data-toggle="tooltip"
               title="{{ $setting->description }}"></i>
        @endif
    </label>

    @if($setting->type === 'textarea')
        <textarea
            name="{{ $setting->key }}"
            id="{{ $setting->key }}"
            class="form-control"
            rows="4"
            placeholder="{{ $setting->description ?? $setting->label }}"
        >{{ old($setting->key, $setting->value) }}</textarea>

    @elseif($setting->type === 'boolean')
        <div class="custom-control custom-switch">
            <input
                type="checkbox"
                class="custom-control-input"
                id="{{ $setting->key }}"
                name="{{ $setting->key }}"
                value="1"
                {{ old($setting->key, $setting->value) == '1' ? 'checked' : '' }}
            >
            <label class="custom-control-label" for="{{ $setting->key }}">
                {{ $setting->description ?? 'Enable this option' }}
            </label>
        </div>

    @elseif($setting->type === 'number')
        <input
            type="number"
            name="{{ $setting->key }}"
            id="{{ $setting->key }}"
            class="form-control"
            value="{{ old($setting->key, $setting->value) }}"
            placeholder="{{ $setting->description ?? $setting->label }}"
        >

    @else
        {{-- Default: text input --}}
        <input
            type="text"
            name="{{ $setting->key }}"
            id="{{ $setting->key }}"
            class="form-control"
            value="{{ old($setting->key, $setting->value) }}"
            placeholder="{{ $setting->description ?? $setting->label }}"
        >
    @endif

    @if($setting->description && $setting->type !== 'boolean')
        <small class="form-text text-muted">
            {{ $setting->description }}
        </small>
    @endif
</div>
