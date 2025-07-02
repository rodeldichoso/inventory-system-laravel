@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-amber-300 dark:border-amber-600 dark:bg-gray-900 dark:text-amber-200 focus:border-amber-500 dark:focus:border-amber-400 focus:ring-amber-500 dark:focus:ring-amber-400 rounded-md shadow-sm bg-yellow-50 text-amber-900 placeholder-amber-400']) }}>