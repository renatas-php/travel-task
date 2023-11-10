<div class="flex flex-col" wire:ignore>
    <label class="px-4 block mb-2 font-medium">{{ $label ?? '' }}</label>
    <input class="form-input border-2 border-[#000] h-14 font-medium w-full bg-transparent px-4 focus:input-focus-shadow rounded-xl focus:outline-none transition-all" id="{{$inputName}}" placeholder="{{ $placeholder ?? '' }}" wire:model="{{ $inputName }}" value="{{ $value ?? '' }}">  
    @if(isset($feedback) && $feedback == true)
        @error($inputName)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @endif
</div>