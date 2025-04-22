<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;600;800&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
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
        .form-wrapper {
            width: 100%;
            max-width: 450px;
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

        /* Animated top border */
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

        /* Form header */
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo {
            font-size: 2.5rem;
            color: var(--primary-neon);
            margin-bottom: 1rem;
            animation: pulse 2s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.7; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.05); }
        }

        .form-title {
            font-family: 'Exo 2', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            color: white;
            text-shadow:
                0 0 5px var(--primary-neon),
                0 0 10px var(--secondary-neon);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }

        /* Status message */
        .status-message {
            background: rgba(0, 229, 255, 0.1);
            border-left: 3px solid var(--primary-neon);
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
        }

        /* Input groups */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #e0e0e0;
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
        }

        .input-field {
            width: 100%;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            padding: 0.75rem 1rem;
            padding-left: 2.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary-neon);
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.3);
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-neon);
            font-size: 1rem;
        }

        /* Error message */
        .input-error {
            color: #ff4d6d;
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        /* Remember me toggle */
        .remember-group {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .toggle-container {
            position: relative;
            width: 50px;
            height: 24px;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: white;
            transition: all 0.3s ease;
        }

        .toggle-input:checked + .toggle-slider {
            transform: translateX(26px);
            background: var(--primary-neon);
            box-shadow: 0 0 8px var(--primary-neon);
        }

        .toggle-input:checked ~ .toggle-container {
            border-color: var(--primary-neon);
        }

        .toggle-label {
            margin-left: 0.75rem;
            font-size: 0.9rem;
            color: #e0e0e0;
        }

        /* Action buttons */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
        }

        .forgot-link {
            color: #e0e0e0;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--primary-neon);
            text-shadow: 0 0 5px rgba(0, 229, 255, 0.5);
        }

        .login-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        .login-button i {
            margin-right: 0.5rem;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow:
                0 0 20px rgba(153, 0, 255, 0.7),
                0 0 30px rgba(0, 229, 255, 0.4);
        }

        .login-button::after {
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

        .login-button:hover::after {
            left: 100%;
        }

        /* Subtle glow corners */
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

        /* Additional animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .floating-element {
            position: absolute;
            opacity: 0.3;
            z-index: -1;
            animation: float 6s infinite ease-in-out;
        }

        .circle-1 {
            width: 80px;
            height: 80px;
            border: 2px solid var(--primary-neon);
            border-radius: 50%;
            top: 10%;
            left: 15%;
        }

        .circle-2 {
            width: 40px;
            height: 40px;
            border: 2px solid var(--secondary-neon);
            border-radius: 50%;
            bottom: 15%;
            right: 10%;
            animation-delay: 1s;
        }

        .square {
            width: 60px;
            height: 60px;
            border: 2px solid var(--primary-neon);
            transform: rotate(45deg);
            bottom: 20%;
            left: 10%;
            animation-delay: 2s;
        }
    </style>
</head>
<body>
    <!-- Stars background -->
    <div class="stars-container" id="stars-container"></div>

    <!-- Floating shapes -->
    <div class="floating-element circle-1"></div>
    <div class="floating-element circle-2"></div>
    <div class="floating-element square"></div>

    <!-- x-guest-layout -->
    <div class="form-wrapper">
        <div class="form-container">
            <!-- Corner glow effects -->
            <div class="corner-glow top-left"></div>
            <div class="corner-glow bottom-right"></div>

            <div class="form-header">
                <div class="login-logo">
                    <i class="fas fa-fingerprint"></i>
                </div>
                <h1 class="form-title">PUBLICACIONES</h1>
            </div>

            <!-- Session Status -->
            @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="input-group">
                    <label for="email" class="input-label">{{ __('Email') }}</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="input-field"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email"
                        >
                    </div>
                    @error('email')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password" class="input-label">{{ __('Password') }}</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="input-field"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                        >
                    </div>
                    @error('password')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me (styled as a toggle) -->
                <div class="remember-group">
                    <label class="toggle-wrapper">
                        <input id="remember_me" type="checkbox" class="toggle-input" name="remember">
                        <div class="toggle-container">
                            <span class="toggle-slider"></span>
                        </div>
                    </label>
                    <span class="toggle-label">{{ __('Remember me') }}</span>
                </div>

                <div class="form-actions">
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="login-button">
                        <i class="fas fa-sign-in-alt"></i> {{ __('Log in') }}
                    </button>
                </div>
            </form>
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
