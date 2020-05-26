
<div class="input-group">
    <div class="custom-file">
        <input name="{{ $name }}" type="file" class="custom-file-input imageUpload {{ $errors->first($name) ? 'is-invalid' : '' }}"
            id="{{ $name }}" aria-describedby="inputGroupFileAddon01" data-id="{{ $name }}-show">
        <label class="custom-file-label"> {{ $labelTitle ?? __('lang.image') }} </label>
    </div>
</div>

<img src="{{ $value ? asset( $path. $value) : asset('uploads/no-img.png') }}" id="{{ $name }}-show"
class="mt-2 img-fluid img-thumbnail {{ !$value ? 'd-none' : '' }}" width="100px" style="height: 80px !important">
