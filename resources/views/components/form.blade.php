<form wire:submit.prevent="{{ $method ?? '' }}" novalidate {{ $attributes->merge(['class' => 'needs-validation']) }}>
    {{ $slot }}
</form>
