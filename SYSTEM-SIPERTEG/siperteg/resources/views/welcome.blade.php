<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a SIPERTEG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #ffcc00, #ff6600);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            text-align: center;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .logo img {
            max-width: 300px;
            height: auto;
            margin-bottom: 20px;
        }

        h1 {
            color: #d40000;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        p {
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn {
            padding: 12px 24px;
            background-color: #ff6600;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #cc3300;
        }

        footer {
            margin-top: 40px;
            color: #fff;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('storage/logo_siperteg.png') }}" alt="Logo de SIPERTEG">
        </div>
        <h1>Bienvenido a SIPERTEG LTDA.</h1>
        <p>Soluciones en conectividad para tu hogar y empresa</p>
        <a href="{{ url('/login') }}" class="btn">Ingresar al Sistema</a>
    </div>
    <footer>
        &copy; {{ date('Y') }} SIPERTEG LTDA. - Todos los derechos reservados
    </footer>
</body>
</html>
