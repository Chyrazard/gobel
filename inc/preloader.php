<?php

defined( 'ABSPATH' ) || exit;

add_action('wp_footer', function () {
	// Kept for compatibility, but opt-in because a full-screen overlay hurts perceived speed.
	if ( ! apply_filters( 'belctech_enable_legacy_preloader', false ) ) {
		return;
	}

    if (!is_front_page()) {
        return;
    }

    ?>

    <div id="chy-preloader">
        <img 
            src="https://vaamcolombia.com/wp-content/uploads/2026/03/VaamGals-.png"
            class="chy-preloader-logo"
            alt="Logo preloader"
        >
    </div>

    <style>
        #chy-preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999999;
            transition: opacity .7s ease;
        }

        .chy-preloader-logo {
            max-width: 300px;
            height: auto;
            opacity: 0;
            animation: chyLogo .7s forwards;
        }

        @media (max-width: 768px) {
            .chy-preloader-logo {
                max-width: 180px;
            }
        }

        @keyframes chyLogo {
            0% { opacity: 0; transform: scale(.9); }
            20% { opacity: 1; transform: scale(1); }
            65% { opacity: 1; transform: scale(1.2); }
            100% { opacity: 0; transform: scale(1.3); }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const preloader = document.getElementById("chy-preloader");
            if (!preloader) return;

            setTimeout(() => {
                preloader.style.opacity = "0";

                setTimeout(() => {
                    preloader.style.display = "none";
                }, 700);

            }, 50);

        });
    </script>

    <?php
});
