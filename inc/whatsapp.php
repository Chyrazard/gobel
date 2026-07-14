<?php
defined( 'ABSPATH' ) || exit;

// Agrega botón de WhatsApp con popup animado (versión API estable)
add_action('wp_footer', function () {
    ?>
    <style>
        .fade-in { animation: fadeIn 0.5s ease forwards; }
        .fade-out { animation: fadeOut 0.5s ease forwards; }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes fadeOut {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0; transform: scale(0.95); }
        }

        @media only screen and (max-width: 767px) {
            #whatsapp-float {
                position: fixed;
                bottom: 55px;
                right: 20px;
                z-index: 1000;
                background: #ff71cb;
                border-radius: 50%;
                padding: 12px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.3);
                cursor: pointer;
                transition: transform 0.5s ease;
            }
        }

        @media only screen and (min-width: 1024px) {
            #whatsapp-float {
                position: fixed;
                bottom: 85px;
                right: 20px;
                z-index: 1000;
                background: #ff71cb;
                border-radius: 50%;
                padding: 12px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.3);
                cursor: pointer;
                transition: transform 0.5s ease;
            }
        }

        #whatsapp-float:hover { transform: rotate(360deg); }
        .whatsapp-icon { width: 40px; height: 40px; }

        #whatsapp-popup {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 300px;
            background: linear-gradient(135deg, #fbd3e9 0%, #e075ae 100%);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            color: white;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
            z-index: 1001;
            display: none;
        }

        .popup-header {
            display: flex;
            align-items: center;
            padding: 15px;
            background: rgba(0,0,0,0.1);
        }

        .popup-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .popup-header h4 { margin: 0; font-size: 16px; }
        .popup-close { margin-left: auto; font-size: 20px; cursor: pointer; }

        .popup-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .popup-body .welcome-message {
            background: rgba(255,255,255,0.2);
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 10px;
            color: black !important;
        }

        .popup-body textarea {
            resize: none;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 14px;
            outline: none;
            min-height: 60px;
            margin-bottom: 10px;
        }

        .popup-body button {
            background: #b50580;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .popup-body button:hover { background: #064e46; }

        .popup-preload {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 0;
        }

        .preload-logo { width: 100px; height: auto; }

        .status-wrapper { display: flex; align-items: center; gap: 6px; }
        .status-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            background-color: #00ff73;
            animation: pulse 1.2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.6; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>

    <!-- Botón flotante -->
    <div id="whatsapp-float">
        <img src="https://vaamcolombia.com/wp-content/uploads/2025/06/whatsapp-white-icon.png" alt="WhatsApp" class="whatsapp-icon" />
    </div>

    <!-- Pop-up -->
    <div id="whatsapp-popup">
        <div id="popup-loader" class="popup-preload fade-in">
            <img src="https://vaamcolombia.com/wp-content/uploads/2025/04/logomid.png" alt="Preload" class="preload-logo">
        </div>
        <div id="popup-content" style="display: none;" class="fade-in">
            <div class="popup-header">
                <img src="https://vaamcolombia.com/wp-content/uploads/2025/04/logomid.png" alt="VAAM" class="popup-avatar">
                <div>
                    <h4 style="color:white !important;">VAAM</h4>
                    <div class="status-wrapper">
                        <div class="status-dot"></div>
                        <p style="color:white;">Activo ahora</p>
                    </div>
                </div>
                <span class="popup-close" onclick="closePopup()">×</span>
            </div>
            <div class="popup-body">
                <div class="welcome-message">
                    Hello ¡VaamGal!♡ Gracias por comunicarte con Vaam. Por favor, haznos saber cómo podemos ayudarte.
                </div>
                <textarea id="whatsapp-message" placeholder="Escribe tu mensaje..."></textarea>
                <button onclick="sendMessage()">Enviar</button>
            </div>
        </div>
    </div>

    <script>
        const popup = document.getElementById('whatsapp-popup');
        const loader = document.getElementById('popup-loader');
        const content = document.getElementById('popup-content');
        const floatBtn = document.getElementById('whatsapp-float');

        function openPopup() {
            popup.style.display = 'block';
            popup.classList.remove('fade-out');
            popup.classList.add('fade-in');
            loader.style.display = 'flex';
            content.style.display = 'none';
            setTimeout(() => {
                loader.style.display = 'none';
                content.style.display = 'block';
                content.classList.add('fade-in');
            }, 500);
        }

        function closePopup() {
            popup.classList.remove('fade-in');
            popup.classList.add('fade-out');
            setTimeout(() => { popup.style.display = 'none'; }, 500);
        }

        floatBtn.addEventListener('click', () => {
            const isOpen = popup.style.display === 'block';
            isOpen ? closePopup() : openPopup();
        });

        // ✅ Solo usa API oficial (sin wa.me)
        function sendMessage() {
            const message = document.getElementById('whatsapp-message').value.trim();
            if (!message) return;
            const encodedMessage = encodeURIComponent(message);
            const phone = '573182508517'; // <-- tu número de WhatsApp
            const apiURL = `https://api.whatsapp.com/send?phone=${phone}&text=${encodedMessage}`;
            window.open(apiURL, '_blank');
        }
    </script>
    <?php
});
