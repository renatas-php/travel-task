<div class="w-full m-auto {{ $class ?? '' }}">
    <label class="px-4 block mb-2 font-medium">{{ $label ?? '' }}</label>
    <div class="border-2 border-[#000] rounded-button w-full min-h-[150px]">
        <textarea autocomplete="on" name="{{ $inputName }}" placeholder="{{ $placeholder ?? '' }}" class="p-[16px] font-medium w-full min-h-[150px] h-full bg-transparent px-4 focus:input-focus-shadow rounded-button focus:outline-none transition-all">{{ $value ?? '' }}</textarea>
    </div>
</div>