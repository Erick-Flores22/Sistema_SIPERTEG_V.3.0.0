<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <x-input-label for="nombre" value="Nombre" />
        <x-text-input id="nombre" name="nombre" type="text" class="block w-full" value="{{ old('nombre', $instalacion->nombre ?? '') }}" required />
        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="celular" value="Celular" />
        <x-text-input id="celular" name="celular" type="text" class="block w-full" value="{{ old('celular', $instalacion->celular ?? '') }}" required />
        <x-input-error :messages="$errors->get('celular')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="direccion" value="Dirección" />
        <x-text-input id="direccion" name="direccion" type="text" class="block w-full" value="{{ old('direccion', $instalacion->direccion ?? '') }}" required />
        <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
    </div>


    <div>
        <x-input-label for="estado" value="Estado" />
        <select id="estado" name="estado" class="block w-full border-gray-300 rounded-md">
            @foreach($estados as $estado)
                <option value="{{ $estado }}" {{ old('estado', $instalacion->estado ?? '') == $estado ? 'selected' : '' }}>
                    {{ $estado }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('estado')" class="mt-2" />
    </div>

    <div class="col-span-2">
        <x-input-label for="observaciones" value="Observaciones" />
        <textarea id="observaciones" name="observaciones" class="block w-full border-gray-300 rounded-md">{{ old('observaciones', $instalacion->observaciones ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
    </div>
</div>
