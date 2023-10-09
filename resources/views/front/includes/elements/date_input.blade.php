<div class="flex flex-col">
    <label class="px-4 block mb-2 font-medium">{{ $label ?? '' }}</label>
    <input class="form-input hidden" type="hidden" id="{{$inputName}}" placeholder="Pasirinkite datą" name="{{ $inputName }}" value="{{ $value ?? '' }}">  
    @if(isset($feedback) && $feedback == true)
        @error($inputName)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @endif
</div>