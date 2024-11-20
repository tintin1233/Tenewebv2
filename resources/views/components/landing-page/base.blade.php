<x-app-layout>
    <x-landing-page.navbar />
    <x-carousel />
    <x-landing-page.content-wrapper>
        {{ $slot }}
    </x-landing-page.content-wrapper>
</x-app-layout>
