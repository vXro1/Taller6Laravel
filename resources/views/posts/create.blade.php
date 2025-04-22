<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Mejorado</title>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;800&family=Work+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-neon: #00e5ff;
            --secondary-neon: #f700ff;
            --text-glow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        body {
            font-family: 'Work Sans', sans-serif;
            background: linear-gradient(135deg, #050520, #000);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            margin: 0;
        }

        /* Fondo de estrellas */
        .stars-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background-color: white;
            border-radius: 50%;
            opacity: 0.5;
        }

        /* Contenedor del formulario */
        .form-wrapper {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .form-container {
            position: relative;
            background: rgba(10, 10, 30, 0.6);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow:
                0 0 20px rgba(0, 0, 0, 0.5),
                0 0 30px rgba(0, 229, 255, 0.2),
                0 0 40px rgba(247, 0, 255, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
            padding: 2.5rem;
        }

        /* Línea de borde superior animada */
        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg,
                transparent,
                var(--primary-neon),
                var(--secondary-neon),
                transparent);
            animation: borderLine 4s linear infinite;
        }

        @keyframes borderLine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Título con mejor contraste */
        .form-title {
            font-family: 'Exo 2', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
            color: white;
            text-shadow:
                0 0 5px var(--primary-neon),
                0 0 10px var(--secondary-neon);
            position: relative;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-title::after {
            content: '';
            display: block;
            width: 50%;
            height: 1px;
            background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.5),
                transparent);
            margin: 0.75rem auto 0;
        }

        /* Campos de entrada mejorados */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #e0e0e0;
            font-weight: 400;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .input-field {
            width: 100%;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            padding: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary-neon);
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.3);
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        textarea.input-field {
            min-height: 150px;
            resize: vertical;
        }

        /* Botón mejorado con contraste */
        .submit-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            margin: 1.5rem auto 0;
            padding: 0.75rem 2rem;
            background: linear-gradient(45deg, #6600cc, #9900ff);
            color: white;
            border: none;
            border-radius: 30px;
            font-family: 'Exo 2', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(153, 0, 255, 0.5);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
        }

        .submit-button i {
            margin-right: 0.5rem;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow:
                0 0 20px rgba(153, 0, 255, 0.7),
                0 0 30px rgba(0, 229, 255, 0.4);
        }

        .submit-button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .submit-button:hover::after {
            left: 100%;
        }

        /* Efectos sutiles de brillo en las esquinas */
        .corner-glow {
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            filter: blur(30px);
            opacity: 0.3;
            z-index: -1;
        }

        .top-left {
            top: -20px;
            left: -20px;
            background: var(--primary-neon);
        }

        .bottom-right {
            bottom: -20px;
            right: -20px;
            background: var(--secondary-neon);
        }
    </style>
    <script>
        // Crear estrellas para el fondo
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.createElement('div');
            container.className = 'stars-container';
            document.body.appendChild(container);

            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.top = `${Math.random() * 100}%`;
                star.style.left = `${Math.random() * 100}%`;
                star.style.width = `${Math.random() * 2 + 1}px`;
                star.style.height = star.style.width;
                star.style.opacity = `${Math.random() * 0.7 + 0.3}`;
                container.appendChild(star);
            }
        });
    </script>
</head>
<body>
    <div class="form-wrapper">
        <div class="form-container">
            <!-- Brillos en las esquinas -->
            <div class="corner-glow top-left"></div>
            <div class="corner-glow bottom-right"></div>

            <h1 class="form-title">Nueva Publicación</h1>

            <form method="POST" action="{{ route('posts.store') }}">
                @csrf

                <div class="input-group">
                    <label class="input-label"><i class="fas fa-heading" style="color: var(--primary-neon);"></i> Título</label>
                    <input type="text" name="titulo" placeholder="Escribe el título aquí..." class="input-field">
                </div>

                <div class="input-group">
                    <label class="input-label"><i class="fas fa-pen-nib" style="color: var(--secondary-neon);"></i> Contenido</label>
                    <textarea name="contenido" placeholder="Escribe tu contenido aquí..." class="input-field"></textarea>
                </div>

                <button type="submit" class="submit-button">
                    <i class="fas fa-paper-plane"></i>
                    Publicar
                </button>
            </form>
        </div>
    </div>
</body>
</html>
