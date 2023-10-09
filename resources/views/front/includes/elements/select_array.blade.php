<div class="relative min-w-[200px] {{ $class ?? '' }}" x-data="{ orderingText: '{{ isset($value) ? $value : $name }}', open: false,  }">
    @isset($label)
    <label class="px-4 block mb-2 font-medium">{{ $label ?? '' }}</label>
    @endif
    <div class="border-2 border-[#000] rounded-xl h-[56px] px-[16px] cursor-pointer flex items-center justify-between font-medium gap-[16px] transition-all" @click="open = ! open" :class="open ? 'hovered-select-input' : ''" @click.away="open = false">
        <span x-text="orderingText"></span>
        <img src="/assets/icons/chevron-down.svg" :class="open ? 'rotate-180' : ''">
    </div>
    @if($feedback == true)
        @error($inputName)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @endif
    <div class="absolute flex flex-col gap-16px border-2 border-[#000] rounded-xl w-full p-16px mt-16px bg-[#fff] z-10 max-h-[200px] overflow-y-scroll" x-show="open">                        
        <div class="cursor-pointer relative" @click="orderingText = '{{ $label ?? '' }}'; open = false">
            <input type="radio" name="{{ $inputName ?? '' }}" value="{{ null }}" class="absolute h-full w-full opacity-0 cursor-pointer" @if(isset($value)) checked @endif>
            <p class="font-medium">{{ $label ?? '' }}</p>                        
        </div>
        @forelse($items as $item)
        <div class="cursor-pointer relative" @click="orderingText = '{{ $item }}'; open = false">
            <input type="radio" value="{{ $item }}" name="{{ $inputName ?? '' }}" class="absolute h-full w-full opacity-0 cursor-pointer" @if(isset($value) && $value == $item) checked @endif> 
            <p class="font-medium">{{ $item }}</p>                        
        </div>
        @empty 
        @endforelse
    </div>
</div>