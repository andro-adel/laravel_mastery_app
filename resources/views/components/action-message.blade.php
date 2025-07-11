@props(['on'])

<div x-data="{ shown: false, timeout: null }" @if(isset($on) && $on)
    x-init="window.addEventListener('livewire:event', e => { if (e.detail.event === '{{ $on }}') { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); } })"
    @endif x-show.transition.out.opacity.duration.1500ms="shown" x-transition:leave.opacity.duration.1500ms
    style="display: none;" {{ $attributes->merge(['class' => 'text-sm text-gray-600']) }}
    >
    {{ $slot->isEmpty() ? __('Saved.') : $slot }}
</div>
