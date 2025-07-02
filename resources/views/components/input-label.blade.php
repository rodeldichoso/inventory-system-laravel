@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-amber-800 dark:text-amber-300']) }}>
    {{ $value ?? $slot }}
</label>