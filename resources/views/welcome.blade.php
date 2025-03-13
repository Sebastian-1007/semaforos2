<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novatech - Sistema de Semaforización Inteligente</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        :root {
            --color-primary: #2563eb;
            --color-secondary: #3b82f6;
            --color-accent: #60a5fa;
            --color-background: #000000; /* Fondo negro */
            --color-text: #e2e8f0;
            --neon-red: #ff4444;
            --neon-yellow: #ffdd44;
            --neon-green: #44ff44;
            --neon-blue: #3b82f6;
            --neon-purple: #bf40bf;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--color-text);
            background: var(--color-background);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Fondo con imagen y partículas */
        body::before {
            content: '';
            position: fixed; /* Fondo fijo */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://th.bing.com/th/id/OIP.WwGNGMWSIyaAs0joqhNAPgHaEK?rs=1&pid=ImgDetMain') no-repeat center center/cover;
            opacity: 0.2;
            z-index: -1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        /* Header y navegación */
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            animation: slideDown 0.5s ease;
            border-bottom: 2px solid var(--neon-blue);
            box-shadow: 0 0 30px var(--neon-blue);
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .nav-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--color-accent);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-shadow: 0 0 0.2px var(--neon-blue);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            color: var(--color-text);
            text-decoration: none;
            position: relative;
            transition: 0.5s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--color-accent);
            transition: 0.5s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--neon-blue), var(--neon-purple));            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titlePulse 2s infinite;
            text-shadow: 0 0 0.2px var(--neon-blue);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #94a3b8;
        }

        /* Contenedor principal del semáforo y servicios */
        .main-content {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            margin-top: 4rem;
        }

        /* Semáforo mejorado */
        .traffic-light-container {
            perspective: 1000px;
            flex: 1;
            max-width: 300px;
        }

        .traffic-light {
            width: 120px;
            height: 320px;
            background: linear-gradient(45deg, #1f2937, #374151);
            border-radius: 30px;
            margin: 20px auto;
            padding: 20px;
            position: relative;
            box-shadow:
                0 0 30px rgba(0, 0, 0, 0.5),
                inset 0 0 15px rgba(255, 255, 255, 0.1);
            transform-style: preserve-3d;
            transform: rotateY(0deg);
            transition: transform 0.5s ease;
            animation: floatLight 3s ease-in-out infinite;
            border: 1px solid var(--neon-blue);
        }

        .traffic-light:hover {
            transform: rotateY(100deg);
        }

        .light {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 20px auto;
            position: relative;
            background: #333;
            box-shadow:
                inset 0 0 20px rgba(0, 0, 0, 0.5),
                0 0 20px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;
        }

        .light::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70%;
            height: 70%;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.5), transparent);
        }

        .light.red.active {
            background: radial-gradient(circle at center, var(--neon-red), #cc0000);
            box-shadow:
                0 0 60px var(--neon-red),
                inset 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .light.yellow.active {
            background: radial-gradient(circle at center, var(--neon-yellow), #ffaa00);
            box-shadow:
                0 0 60px var(--neon-yellow),
                inset 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .light.green.active {
            background: radial-gradient(circle at center,var(--neon-green), #00cc00);
            box-shadow:
                0 0 60px var(--neon-green),
                inset 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .light-status {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-top: 2rem;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            animation: statusPulse 3s infinite;
        }

        /* Servicios al lado derecho */
        .services {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            transition: 0.4s;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: translateX(-100%);
            transition: 0.5s;
        }

        .service-card:hover::before {
            transform: translateX(100%);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow:
                0 0 10px var(--neon-blue),
                0 0 20px var(--neon-blue),
                0 0 40px var(--neon-blue);
            border-color: var(--neon-blue);
        }

        /* Efecto neón al pasar el cursor */
        .service-card:hover {
            border: 2px solid var(--neon-blue);
            box-shadow:
                0 0 10px var(--neon-blue),
                0 0 20px var(--neon-blue),
                0 0 40px var(--neon-blue);
        }

        /* Animaciones */
        @keyframes floatLight {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        @keyframes statusPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        /* Botón CTA */
        .cta-button {
            background: linear-gradient(45deg, var(--color-blue), var(--color-purple));
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 30px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 20px var(--neon-blue);
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.6s;
        }

        .cta-button:hover::before {
            left: 100%;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow:
                0 0 20px var(--neon-blue),
                0 0 40px var(--neon-blue);        }

        /* Footer */
        .footer {
            background: rgba(255, 255, 255, 0.05);
            padding: 2rem 0;
            margin-top: 4rem;
            text-align: center;
            border-top: 2px solid var(--neon-blue);
            box-shadow: 0 0 10px var(--neon-blue);
        }

        .footer a {
            color: var(--neon-blue);
            text-decoration: none;
            margin: 0 1rem;
            transition: 0.3s;
        }

        .footer a:hover {
            color: var(--color-text);
        }

        /* Partículas en movimiento */
        .particles {
            position: fixed; /* Partículas fijas */
            top: 40px;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: var(--neon-blue);
            border-radius: 50%;
            opacity: 0.5;
            animation: floatParticle 6s infinite ease-in-out;
        }

        @keyframes floatParticle {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-30px) translateX(30px); }
        }
    </style>
</head>
<body>
    <!-- Partículas en movimiento -->
    <div class="particles">
        <div class="particle" style="top: 10%; left: 20%;"></div>
        <div class="particle" style="top: 30%; left: 50%;"></div>
        <div class="particle" style="top: 70%; left: 80%;"></div>
        <div class="particle" style="top: 50%; left: 10%;"></div>
        <div class="particle" style="top: 90%; left: 40%;"></div>
    </div>

    <header class="header">
        <nav class="nav">
            <a href="#" class="nav-logo">
                <i class="fas fa-traffic-light"></i>
                Novatech
            </a>
            <div class="nav-links">
                <a href="{{ route('user.login') }}" class="nav-link">Login</a>
                <a href="{{ route('user.register') }}" class="nav-link">Register</a>
                <a href="{{ route('admin.login') }}" class="nav-link">Administrador</a>
            </div>
        </nav>
    </header>

    <div class="container">
        <section class="hero">
            <h1>Sistema de Semaforización Inteligente</h1>
            <p>Transformando el tráfico urbano con tecnología de vanguardia</p>
             <a href="{{ route('user.register') }}" class="cta-button">
               <i class="fas fa-arrow-right"></i> Comenzar
             </a>

        </section>

        <!-- Contenedor principal del semáforo y servicios -->
        <div class="main-content">
            <!-- Semáforo -->
            <div class="traffic-light-container">
                <div class="traffic-light">
                    <div class="light red" id="red-light"></div>
                    <div class="light yellow" id="yellow-light"></div>
                    <div class="light green" id="green-light"></div>
                </div>
                <div class="light-status" id="light-status">Iniciando sistema...</div>
            </div>

            <!-- Servicios -->
            <div class="services">
                <div class="service-card">
                    <i class="fas fa-robot fa-3x"></i>
                    <h3>Control Inteligente</h3>
                    <p>Algoritmos avanzados que optimizan el flujo del tráfico en tiempo real.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-chart-line fa-3x"></i>
                    <h3>Análisis en Tiempo Real</h3>
                    <p>Monitoreo constante y ajuste automático según las condiciones del tráfico.</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-leaf fa-3x"></i>
                    <h3>Eco-Friendly</h3>
                    <p>Reducción de emisiones mediante la optimización de los tiempos de espera.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>© 2025 Novatech - Sistema de Semaforización Inteligente Proyecto Escolar de la Universidad Tegnologica del Valle de Toluca.</p>
        <div>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </footer>

    <script>
        const redLight = document.getElementById('red-light');
        const yellowLight = document.getElementById('yellow-light');
        const greenLight = document.getElementById('green-light');
        const lightStatus = document.getElementById('light-status');

        function updateStatus(text, color) {
            lightStatus.textContent = text;
            lightStatus.style.color = color;
        }

        function changeLight() {
            // Rojo
            setTimeout(() => {
                redLight.classList.add('active');
                yellowLight.classList.remove('active');
                greenLight.classList.remove('active');
                updateStatus('¡ALTO!', '#ff4444');
            }, 0);

            // Amarillo
            setTimeout(() => {
                redLight.classList.remove('active');
                yellowLight.classList.add('active');
                greenLight.classList.remove('active');
                updateStatus('¡PRECAUCIÓN!', '#ffdd44');
            }, 5000);

            // Verde
            setTimeout(() => {
                redLight.classList.remove('active');
                yellowLight.classList.remove('active');
                greenLight.classList.add('active');
                updateStatus('¡AVANCE!', '#44ff44');
            }, 7000);

            // Reiniciar ciclo
            setTimeout(() => {
                changeLight();
            }, 12000);
        }

        // Iniciar el ciclo del semáforo
        changeLight();

        // Animación de hover 3D para el semáforo
        const trafficLight = document.querySelector('.traffic-light');

        document.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
            trafficLight.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });

        // Restaurar posición original cuando el mouse sale
        trafficLight.addEventListener('mouseleave', () => {
            trafficLight.style.transform = 'rotateY(0) rotateX(0)';
        });
    </script>
</body>
</html>
