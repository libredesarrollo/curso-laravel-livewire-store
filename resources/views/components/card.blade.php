<div
    {{ $attributes->merge(['class' => ' flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100']) }}>

    <div class="w-full sm:max-w-4xl mt-6 bg-white shadow-md overflow-hidden sm:rounded-lg">

        @if (isset($title))
            <div class="bg-gray-50 py-3">
                <h2 class="text-3xl text-center text-gray-600">{{ $title }}</h2>
            </div>
        @endif

        <div class="px-6 py-4">
            {{ $slot }}
        </div>
    </div>
</div>
