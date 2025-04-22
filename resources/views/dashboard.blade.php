<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight neon-text">
            {{ __('Todas las Publicaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Botón para crear nueva publicación -->
            <div>
                <a href="{{ route('posts.create') }}" class="inline-block submit-button">
                    <i class="fas fa-plus"></i> Crear nueva publicación
                </a>
            </div>

            <!-- Lista de todas las publicaciones -->
            @forelse($todas as $post)
                <div class="form-container post-card">
                    <div class="corner-glow top-left"></div>
                    <div class="corner-glow bottom-right"></div>

                    <h3 class="text-lg font-semibold text-white">{{ $post->titulo }}</h3>
                    <p class="text-sm text-gray-300">{{ \Illuminate\Support\Str::limit($post->contenido, 100) }}</p>
                    <p class="text-xs text-gray-400 mt-2">Autor: {{ $post->user->name ?? 'Desconocido' }}</p>

                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('posts.show', $post) }}" class="neon-link primary-neon">Ver</a>

                        @if(auth()->id() === $post->user_id)
                            <a href="{{ route('posts.edit', $post) }}" class="neon-link warning-neon">Editar</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta publicación?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="neon-link danger-neon">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="form-container post-card empty-card">
                    <div class="corner-glow top-left"></div>
                    <div class="corner-glow bottom-right"></div>
                    <p class="text-gray-300">No hay publicaciones disponibles.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

<style>
    :root {
        --primary-neon: #00e5ff;
        --secondary-neon: #f700ff;
        --warning-neon: #ffbb00;
        --danger-neon: #ff0055;
        --text-glow: 0 0 10px rgba(255, 255, 255, 0.8);
    }

    body {
        font-family: 'Work Sans', sans-serif;
        background: linear-gradient(135deg, #050520, #000);
        min-height: 100vh;
        padding: 0;
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
        animation: twinkle 3s infinite ease-in-out;
    }

    @keyframes twinkle {
        0% { opacity: 0.3; }
        50% { opacity: 1; }
        100% { opacity: 0.3; }
    }

    /* Diseño de tarjetas de publicaciones */
    .post-card {
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .post-card:hover {
        transform: translateY(-5px);
        box-shadow:
            0 0 25px rgba(0, 0, 0, 0.6),
            0 0 35px rgba(0, 229, 255, 0.3),
            0 0 45px rgba(247, 0, 255, 0.2);
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
        padding: 1.5rem;
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

    /* Título con efecto neón */
    .neon-text {
        color: white;
        text-shadow:
            0 0 5px var(--primary-neon),
            0 0 10px var(--secondary-neon);
        position: relative;
        letter-spacing: 1px;
    }

    /* Links con efecto neón */
    .neon-link {
        display: inline-block;
        color: white;
        text-decoration: none;
        padding: 0.3rem 0.75rem;
        border-radius: 4px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .primary-neon {
        text-shadow: 0 0 5px var(--primary-neon);
    }

    .primary-neon:hover {
        box-shadow: 0 0 15px var(--primary-neon);
        border-color: var(--primary-neon);
    }

    .warning-neon {
        text-shadow: 0 0 5px var(--warning-neon);
    }

    .warning-neon:hover {
        box-shadow: 0 0 15px var(--warning-neon);
        border-color: var(--warning-neon);
    }

    .danger-neon {
        text-shadow: 0 0 5px var(--danger-neon);
    }

    .danger-neon:hover {
        box-shadow: 0 0 15px var(--danger-neon);
        border-color: var(--danger-neon);
    }

    /* Botón mejorado con contraste */
    .submit-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: auto;
        margin: 0.5rem 0 1.5rem;
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
        opacity: 0.15;
        z-index: -1;
        transition: all 0.3s ease;
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

    .post-card:hover .corner-glow {
        opacity: 0.3;
        filter: blur(25px);
    }

    /* Estilos para la tarjeta vacía */
    .empty-card {
        text-align: center;
        padding: 2rem;
        opacity: 0.8;
    }

    /* Ajustes para dark mode */
    @media (prefers-color-scheme: dark) {
        body {
            background: linear-gradient(135deg, #050520, #000);
        }
    }

    /* Estilos para el header */
    [name="header"] {
        background: rgba(10, 10, 30, 0.8);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 20px rgba(0, 229, 255, 0.2);
    }
</style>

<script>
    // Crear estrellas para el fondo
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.createElement('div');
        container.className = 'stars-container';
        document.body.appendChild(container);

        for (let i = 0; i < 150; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            star.style.top = `${Math.random() * 100}%`;
            star.style.left = `${Math.random() * 100}%`;
            star.style.width = `${Math.random() * 2 + 1}px`;
            star.style.height = star.style.width;
            star.style.opacity = `${Math.random() * 0.7 + 0.3}`;
            star.style.animationDelay = `${Math.random() * 5}s`;
            container.appendChild(star);
        }

        // Añadir "mouse trail" efecto para el cursor
        let mouseX = 0, mouseY = 0;
        document.addEventListener('mousemove', function(e) {
            mouseX = e.clientX;
            mouseY = e.clientY;

            // Crear una estrella en la posición del ratón
            if (Math.random() > 0.9) {
                const trailStar = document.createElement('div');
                trailStar.className = 'star';
                trailStar.style.width = '3px';
                trailStar.style.height = '3px';
                trailStar.style.top = `${mouseY}px`;
                trailStar.style.left = `${mouseX}px`;
                trailStar.style.opacity = '1';
                container.appendChild(trailStar);

                // Animar y eliminar el rastro
                setTimeout(() => {
                    trailStar.style.opacity = '0';
                    trailStar.style.transform = `translate(${(Math.random() - 0.5) * 20}px, ${(Math.random() - 0.5) * 20}px)`;
                    setTimeout(() => {
                        container.removeChild(trailStar);
                    }, 1000);
                }, 10);
            }
        });

        // Añadir efecto de pulse a las tarjetas
        const cards = document.querySelectorAll('.post-card');
        cards.forEach(card => {
            const leftGlow = card.querySelector('.top-left');
            const rightGlow = card.querySelector('.bottom-right');

            setInterval(() => {
                leftGlow.style.opacity = '0.3';
                setTimeout(() => {
                    leftGlow.style.opacity = '0.15';
                }, 1000);
            }, 2000);

            setInterval(() => {
                rightGlow.style.opacity = '0.3';
                setTimeout(() => {
                    rightGlow.style.opacity = '0.15';
                }, 1000);
            }, 2800);
        });
    });
</script>
