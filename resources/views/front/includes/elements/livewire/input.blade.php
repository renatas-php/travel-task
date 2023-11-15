<div class="{{ $class ?? '' }}" wire:ignore.self>
    <label class="px-4 block mb-2 font-medium">{{ $label ?? '' }}</label>
    <div class="border-2 border-[#000] rounded-xl w-full h-14 ">
        <input wire:model="{{ $inputName ?? '' }}" min="{{ $min ?? 1 }}" max="{{ $max ?? '' }}" type="{{ isset($type) ? $type : 'text' }}" value="{{ $value ?? '' }}" placeholder="{{ $placeholder ?? '' }}" class="font-medium w-full h-full bg-transparent px-4 focus:input-focus-shadow rounded-button focus:outline-none transition-all" autocomplete="on">
    </div>
    @if(isset($feedback) && $feedback == true)
        @error($inputName)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @endif
</div>