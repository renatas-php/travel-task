<div class="flex flex-col" wire:ignore>
    <label class="px-4 block mb-2 font-medium">{{ $label ?? '' }}</label>
    <input class="form-input hidden" type="hidden" id="{{$inputName}}" placeholder="Pasirinkite datą" wire:model="{{ $inputName }}" value="{{ $value ?? '' }}">  
    @if(isset($feedback) && $feedback == true)
        @error($inputName)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @endif
</div>