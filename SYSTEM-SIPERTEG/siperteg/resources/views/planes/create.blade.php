<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Crear plan de Internet
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">

            <form method="POST" action="{{ route('planes.store') }}" class="space-y-4">
                @csrf

                @include('planes.form')

                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Guardar plan
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
