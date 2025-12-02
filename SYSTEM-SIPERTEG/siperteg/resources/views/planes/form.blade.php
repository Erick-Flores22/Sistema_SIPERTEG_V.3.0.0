<div class="grid grid-cols-2 gap-4">

    <div>
        <label class="block font-medium">Nombre del Plan</label>
        <input type="text" name="nombre"
               value="{{ old('nombre', $plan->nombre ?? '') }}"
               class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-medium">Precio Mensual (Bs)</label>
        <input type="number" step="0.01" name="precio_mensual"
               value="{{ old('precio_mensual', $plan->precio_mensual ?? '') }}"
               class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-medium">Velocidad (Mbps)</label>
        <input type="number" name="velocidad_megas"
               value="{{ old('velocidad_megas', $plan->velocidad_megas ?? '') }}"
               class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-medium">TV Permitidos</label>
        <input type="number" name="dispositivos_tv"
               value="{{ old('dispositivos_tv', $plan->dispositivos_tv ?? '') }}"
               class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-medium">Computadoras Permitidas</label>
        <input type="number" name="dispositivos_pc"
               value="{{ old('dispositivos_pc', $plan->dispositivos_pc ?? '') }}"
               class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-medium">Celulares Permitidos</label>
        <input type="number" name="dispositivos_celular"
               value="{{ old('dispositivos_celular', $plan->dispositivos_celular ?? '') }}"
               class="w-full border rounded p-2" required>
    </div>

    <div>
        <label class="block font-medium">Precio Instalación (Bs)</label>
        <input type="number" step="0.01" name="precio_instalacion"
               value="{{ old('precio_instalacion', $plan->precio_instalacion ?? '') }}"
               class="w-full border rounded p-2" required>
    </div>

    <div class="flex items-center gap-2">
        <input type="hidden" name="es_promocion" value="0">

<input type="checkbox" name="es_promocion" value="1"
       @checked(old('es_promocion', $plan->es_promocion ?? false))>

<label class="font-medium">¿Instalación en promoción?</label>

    </div>

    <div>
        <label class="block font-medium">Precio en promoción (Bs)</label>
        <input type="number" step="0.01" name="precio_promocion_instalacion"
               value="{{ old('precio_promocion_instalacion', $plan->precio_promocion_instalacion ?? '') }}"
               class="w-full border rounded p-2">
    </div>

</div>

@if ($errors->any())
    <div class="mt-4 p-3 bg-red-200 text-red-800 rounded">
        <strong>Errores:</strong>
        <ul class="list-disc ml-6">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
