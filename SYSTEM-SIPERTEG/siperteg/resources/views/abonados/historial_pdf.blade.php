{{-- resources/views/abonados/historial_pdf.blade.php --}}
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Historial de {{ $abonado->nombre }} {{ $abonado->apellido }}</title>

  <style>
    /* ===============================
       CONFIGURACIÓN GENERAL DE PÁGINA
       =============================== */
    @page {
      margin: 80px 30px 60px 30px; /* top, right, bottom, left */
    }

    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      color: #333;
      margin: 0;
      padding: 0;
    }

    /* ===============================
       HEADER FIJO CON LOGO Y TÍTULO
       =============================== */
    header {
      position: fixed;
      top: -60px;
      left: 0;
      right: 0;
      height: 60px;
      border-bottom: 1px solid #ccc;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 15px;
    }

    header img.logo {
      height: 45px;
    }

    header .header-title {
      flex: 1;
      text-align: center;
      font-weight: bold;
      font-size: 16px;
      color: #444;
    }

    /* ===============================
       FOOTER FIJO CON NÚMERO DE PÁGINA
       =============================== */
    footer {
      position: fixed;
      bottom: -45px;
      left: 0;
      right: 0;
      height: 30px;
      border-top: 1px solid #ccc;
      font-size: 10px;
      color: #555;
      text-align: right;
      padding: 5px 20px 0 0;
    }

    .pagenum:before {
      content: counter(page);
    }

    /* ===============================
       ESTILOS DE CONTENIDO
       =============================== */
    main {
      margin-top: 10px;
    }

    h1 {
      font-size: 20px;
      text-align: center;
      color: #222;
      margin-bottom: 15px;
    }

    .section {
      margin-bottom: 20px;
      page-break-inside: avoid;
    }

    .section h2 {
      font-size: 15px;
      color: #444;
      border-bottom: 2px solid #888;
      margin-bottom: 8px;
      padding-bottom: 3px;
    }

    p {
      margin: 4px 0;
    }

    strong {
      color: #222;
    }

    /* ===============================
       TABLAS (ESTILO ZEBRA)
       =============================== */
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 11px;
      margin-top: 6px;
    }

    th, td {
      border: 1px solid #bbb;
      padding: 6px 8px;
      text-align: left;
    }

    thead {
      background-color: #f3f3f3;
    }

    tbody tr:nth-child(even) {
      background-color: #fafafa;
    }

    tbody tr:nth-child(odd) {
      background-color: #fff;
    }

    /* ===============================
       FOTO DEL PLANO
       =============================== */
    .plano-container {
      text-align: center;
      margin-top: 8px;
    }

    .plano-container img {
      max-height: 200px;
      border: 1px solid #ccc;
      padding: 4px;
      background: #fff;
    }
  </style>
</head>
<body>

  {{-- HEADER --}}
  <header>
    {{-- Cambia la ruta del logo según dónde lo guardes --}}
    <img src="{{ public_path('storage/logo_siperteg.png') }}" alt="Logo Empresa" class="logo">
    <div class="header-title">Historial del Abonado</div>
  </header>

  {{-- FOOTER --}}
  <footer>
    Página <span class="pagenum"></span>
  </footer>

  {{-- CONTENIDO PRINCIPAL --}}
  <main>
    <h1>Historial de {{ $abonado->nombre }} {{ $abonado->apellido }}</h1>

    {{-- DATOS PERSONALES --}}
    <div class="section">
      <h2>Datos Personales</h2>
      <p><strong>CI:</strong> {{ $abonado->ci }}</p>
      <p><strong>Teléfono 1:</strong> {{ $abonado->telefono1 }}</p>
      <p><strong>Teléfono 2:</strong> {{ $abonado->telefono2 ?? '–' }}</p>
      <p><strong>Dirección:</strong> {{ $abonado->zona }}, {{ $abonado->calle }} #{{ $abonado->numero_casa }}</p>
      <p><strong>Fecha de Corte:</strong> {{ optional($abonado->fecha_corte)->format('d/m/Y') ?? '–' }}</p>
      <p><strong>Estado:</strong> {{ ucfirst($abonado->estado) }}</p>
    </div>

    {{-- DATOS TÉCNICOS --}}
<div class="section">
  <h2>Datos Técnicos</h2>
  @if($abonado->datosTecnico)
    @php($d = $abonado->datosTecnico)

    <p><strong>Plan:</strong> {{ $d->plan ?? '–' }}</p>
    <p><strong>ODN:</strong> {{ $d->odn ?? '–' }}</p>
    <p><strong>PON:</strong> {{ $d->pon ?? '–' }}</p>
    <p><strong>Password:</strong> {{ $d->password ?? '–' }}</p>

    <p><strong>Código Técnico:</strong> {{ $d->codigo_tecnico ?? '–' }}</p>
    <p><strong>Código Sistema:</strong> {{ $d->codigo_sistema ?? '–' }}</p>

    {{-- Soporta tanto relación como campo plano --}}
    <p><strong>Nodo:</strong> {{ $d->nodo?->nombre ?? $d->nodo ?? '–' }}</p>
    <p><strong>Caja Distribución:</strong> {{ $d->cajaDistribucion?->nombre ?? $d->caja_distribucion ?? '–' }}</p>

    <p><strong>Fecha de Instalación:</strong> {{ optional($d->fecha_instalacion)->format('d/m/Y') ?? '–' }}</p>

    {{-- Campos que faltaban --}}
    <p><strong>Potencia Partida:</strong> {{ $d->potencia_partida ?? '–' }}</p>
    <p><strong>Potencia Llegada:</strong> {{ $d->potencia_llegada ?? '–' }}</p>

    <p><strong>Observaciones:</strong> {{ $d->observaciones ?? '–' }}</p>

    @if(!empty($d->foto_plano))
      <div class="plano-container">
        <img src="{{ storage_path('app/public/'.$d->foto_plano) }}" alt="Foto Plano">
      </div>
    @endif
  @else
    <p>No hay datos técnicos registrados.</p>
  @endif
</div>

    {{-- COBROS --}}
    <div class="section">
      <h2>Cobros</h2>
      @if($abonado->cobros->isEmpty())
        <p>Sin cobros registrados.</p>
      @else
        <table>
          <thead>
            <tr>
              <th>Periodo</th>
              <th>Fecha de Pago</th>
              <th>Monto</th>
              <th>Plataforma</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach($abonado->cobros as $c)
              <tr>
                <td>{{ $c->periodo->mes }}/{{ $c->periodo->gestion->anio }}</td>
                <td>{{ optional($c->fecha_pago)->format('d/m/Y') ?? '–' }}</td>
                <td>${{ number_format($c->monto, 2, ',', '.') }}</td>
                <td>{{ $c->plataforma ?? '–' }}</td>
                <td>{{ ucfirst($c->estado_pago) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>

    {{-- FALLAS --}}
    <div class="section">
      <h2>Fallas</h2>
      @if($abonado->fallas->isEmpty())
        <p>Sin fallas reportadas.</p>
      @else
        <table>
          <thead>
            <tr>
              <th>Tipo</th>
              <th>Detalle</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach($abonado->fallas as $f)
              <tr>
                <td>{{ ucfirst($f->tipo_falla) }}</td>
                <td>{{ $f->detalle ?? '–' }}</td>
                <td>{{ ucfirst($f->estado) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>

  </main>
</body>
</html>
