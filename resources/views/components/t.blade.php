@props(['en', 'bn'])
{{-- Bilingual text pair. Visibility follows html[data-lang]; strings are authored in the view (trusted). --}}
<span class="i18n-en">{!! $en !!}</span><span class="i18n-bn" lang="bn">{!! $bn !!}</span>
