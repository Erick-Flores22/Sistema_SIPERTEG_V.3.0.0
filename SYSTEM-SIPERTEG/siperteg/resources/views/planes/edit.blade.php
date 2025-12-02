<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Editar plan: {{ $plan->nombre }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">

            <form method="POST" action="{{ route('planes.update', $plan) }}" class="space-y-4">
                @csrf
                @method('PUT')

                @include('planes.form')

                <button class="mt-4 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                    Actualizar plan
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
