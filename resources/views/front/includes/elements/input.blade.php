<div class="w-full m-auto">
    <label class="px-4 block mb-2 font-medium">{{ $label ?? '' }}</label>
    <div class="border-2 border-[#000] rounded-xl w-full h-14 ">
        <input name="{{ $inputName ?? '' }}" min="{{ $min ?? 1 }}" max="{{ $max ?? '' }}" type="{{ isset($type) ? $type : 'text' }}" value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}" class="font-medium w-full h-full rounded-xl placeholder-black bg-transparent px-4 focus:outline-none transition-all" autocomplete="on">
    </div>
    @if(isset($feedback) && $feedback == true)
        @error($inputName)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @endif
</div>