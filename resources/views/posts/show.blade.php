<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Publicación</title>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;800&family=Work+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-neon: #00e5ff;
            --secondary-neon: #f700ff;
            --edit-button: #3b82f6;
            --delete-button: #ef4444;
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

        /* Contenedor del post */
        .post-wrapper {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .post-container {
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
        .post-container::before {
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

        /* Título del post */
        .post-title {
            font-family: 'Exo 2', sans-serif;
            font-weight: 800;
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
            color: white;
            text-shadow:
                0 0 5px var(--primary-neon),
                0 0 15px rgba(247, 0, 255, 0.5);
            letter-spacing: 0.5px;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .post-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg,
                var(--primary-neon),
                transparent);
        }

        /* Contenido del post */
        .post-content {
            color: #e0e0e0;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 2rem;
            position: relative;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            border-left: 2px solid var(--primary-neon);
        }

        /* Botones de acción */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.6rem 1.5rem;
            color: white;
            border: none;
            border-radius: 30px;
            font-family: 'Exo 2', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn::after {
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

        .btn:hover::after {
            left: 100%;
        }

        .edit-btn {
            background: linear-gradient(45deg, #0052cc, var(--edit-button));
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
        }

        .edit-btn:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.7);
        }

        .delete-btn {
            background: linear-gradient(45deg, #cc0000, var(--delete-button));
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.5);
        }

        .delete-btn:hover {
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.7);
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
    <div class="post-wrapper">
        <div class="post-container">
            <!-- Brillos en las esquinas -->
            <div class="corner-glow top-left"></div>
            <div class="corner-glow bottom-right"></div>

            <h1 class="post-title">{{ $post->titulo }}</h1>

            <div class="post-content">
                {{ $post->contenido }}
            </div>

            <div class="action-buttons">
                <a href="{{ route('posts.edit', $post) }}" class="btn edit-btn">
                    <i class="fas fa-pen"></i> Editar
                </a>

                <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn delete-btn" onclick="return confirm('¿Estás seguro que deseas eliminar esta publicación?')">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
