<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Publications</title>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;800&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            color: white;
        }

        /* Stars background */
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

        /* Content container */
        .content-wrapper {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        .content-container {
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

        /* Animated top border */
        .content-container::before {
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

        /* Title with better contrast */
        .page-title {
            font-family: 'Exo 2', sans-serif;
            font-weight: 800;
            font-size: 2.2rem;
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

        .page-title::after {
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

        /* New post button */
        .new-post-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            padding: 0.6rem 1.5rem;
            background: linear-gradient(45deg, #6600cc, #9900ff);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 30px;
            font-family: 'Exo 2', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(153, 0, 255, 0.5);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
        }

        .new-post-btn i {
            margin-right: 0.5rem;
        }

        .new-post-btn:hover {
            transform: translateY(-2px);
            box-shadow:
                0 0 20px rgba(153, 0, 255, 0.7),
                0 0 30px rgba(0, 229, 255, 0.4);
        }

        .new-post-btn::after {
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

        .new-post-btn:hover::after {
            left: 100%;
        }

        /* Posts list */
        .posts-container {
            margin-top: 2rem;
            width: 100%;
        }

        .posts-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .post-item {
            margin-bottom: 0.75rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .post-link {
            display: block;
            padding: 0.75rem 1rem;
            color: #e0e0e0;
            text-decoration: none;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .post-link:hover {
            background: rgba(0, 229, 255, 0.1);
            border-color: var(--primary-neon);
            transform: translateX(5px);
            color: white;
            text-shadow: 0 0 5px rgba(0, 229, 255, 0.5);
        }

        .post-link::before {
            content: '>';
            position: absolute;
            left: 0.5rem;
            opacity: 0;
            color: var(--primary-neon);
            transition: all 0.3s ease;
        }

        .post-link:hover::before {
            opacity: 1;
            left: 0.75rem;
        }

        /* Subtle glow effects in corners */
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

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 2rem 0;
            color: rgba(255, 255, 255, 0.6);
            font-style: italic;
        }

        /* Action buttons container */
        .action-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <!-- Stars background -->
    <div class="stars-container" id="stars-container"></div>

    <div class="content-wrapper">
        <div class="content-container">
            <!-- Corner glow effects -->
            <div class="corner-glow top-left"></div>
            <div class="corner-glow bottom-right"></div>

            <h1 class="page-title">Publicaciones</h1>

            <div class="action-buttons">
                <a href="{{ route('posts.create') }}" class="new-post-btn">
                    <i class="fas fa-plus"></i> Nueva publicacion
                </a>
            </div>

            <div class="posts-container">
                @if(count($posts) > 0)
                    <ul class="posts-list">
                        @foreach($posts as $post)
                            <li class="post-item">
                                <a href="{{ route('posts.show', $post) }}" class="post-link">{{ $post->titulo }}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="empty-state">No publications yet. Create your first one!</div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Create stars background
        document.addEventListener('DOMContentLoaded', function() {
            const starsContainer = document.getElementById('stars-container');
            const starsCount = 100;

            for (let i = 0; i < starsCount; i++) {
                const star = document.createElement('div');
                star.classList.add('star');

                // Random position
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;

                // Random size
                const size = Math.random() * 2 + 1;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;

                // Random opacity
                star.style.opacity = Math.random() * 0.8 + 0.2;

                // Add random twinkle animation
                if (Math.random() > 0.7) {
                    star.style.animation = `twinkle ${Math.random() * 5 + 3}s infinite ease-in-out`;
                }

                starsContainer.appendChild(star);
            }
        });

        // Add twinkle animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes twinkle {
                0%, 100% { opacity: 0.2; }
                50% { opacity: 0.8; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
