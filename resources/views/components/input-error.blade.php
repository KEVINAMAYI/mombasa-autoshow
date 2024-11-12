@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="text-danger">
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
