<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-md mx-auto">
                    <!-- Accordion Item 1 -->
                    <x-accordion-item title="Tasks Today" :tasks="$today"/>

                    <!-- Accordion Item 2 -->
                    <x-accordion-item title="Tasks Tomorrow" :tasks="$tomorrow"/>

                    <!-- Accordion Item 3 -->
                    <x-accordion-item title="Tasks Next Week" :tasks="$nextWeek"/>

                    <!-- Accordion Item 4 -->
                    <x-accordion-item title="Tasks Near Future" :tasks="$nearFuture"/>

                    <!-- Accordion Item 5 -->
                    <x-accordion-item title="Tasks Far Future" :tasks="$farFuture"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
