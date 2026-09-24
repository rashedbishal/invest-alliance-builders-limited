{{-- Prototype annotation. Only visible while "Prototype notes" is switched on; never part of the final design. --}}
<span {{ $attributes->merge(['class' => 'note']) }}>{{ $slot }}</span>
