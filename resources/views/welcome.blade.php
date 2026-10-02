<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>FIBRATEC IPTV</title>

    <style>

        /* =====================================================
           GENERAL
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #05060d;
            color: #ffffff;
        }

        body {
            overflow: hidden;
        }

        button,
        input {
            font-family: inherit;
        }

        button {
            cursor: pointer;
        }


        /* =====================================================
           LOGIN
        ===================================================== */

        #loginPage {

            width: 100%;
            height: 100vh;

            display: flex;

            align-items: center;

            background:
                radial-gradient(
                    circle at 75% 20%,
                    rgba(120, 45, 255, .20),
                    transparent 35%
                ),
                radial-gradient(
                    circle at 85% 80%,
                    rgba(20, 100, 255, .15),
                    transparent 35%
                ),
                #05060d;
        }


        .login-container {

            width: 390px;

            margin-left: 8%;

            padding: 42px 34px;

            background:
                rgba(13, 14, 29, .96);

            border:
                1px solid #292b45;

            border-radius: 18px;

            box-shadow:
                0 30px 80px
                rgba(0,0,0,.65);
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {

            display: flex;

            justify-content: center;

            align-items: center;

            gap: 12px;

            margin-bottom: 40px;
        }


        .logo-icon {

            width: 58px;
            height: 58px;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 31px;

            font-weight: 900;

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #22d3ee
                );

            clip-path:
                polygon(
                    0 0,
                    100% 0,
                    70% 100%,
                    0 100%,
                    27% 50%
                );
        }


        .logo-name {

            font-size: 28px;

            font-weight: 800;

            letter-spacing: 1px;
        }


        .logo-iptv {

            margin-top: 5px;

            color: #8b5cf6;

            font-size: 22px;

            font-weight: 700;
        }


        .login-title {

            text-align: center;

            margin-bottom: 28px;

            font-size: 18px;

            color: #f1f1f5;
        }


        /* =====================================================
           CAMPOS LOGIN
        ===================================================== */

        .field {

            margin-bottom: 20px;
        }


        .field label {

            display: block;

            margin-bottom: 8px;

            color: #a9adbd;

            font-size: 13px;
        }


        .input-container {

            height: 54px;

            display: flex;

            align-items: center;

            background: #171925;

            border:
                1px solid #30334a;

            border-radius: 9px;
        }


        .input-container:focus-within {

            border-color: #6366f1;

            box-shadow:
                0 0 0 2px
                rgba(145,69,255,.15);
        }


        .input-icon {

            width: 45px;

            text-align: center;

            color: #8d91a3;

            font-size: 18px;
        }


        .input-container input {

            flex: 1;

            width: 100%;

            height: 100%;

            border: none;

            outline: none;

            background: transparent;

            color: #ffffff;

            font-size: 15px;
        }


        .input-container input::placeholder {

            color: #666a7b;
        }


        .password-button {

            width: 45px;

            height: 100%;

            border: none;

            background: transparent;

            color: #85899a;

            font-size: 18px;
        }


        .remember {

            display: flex;

            align-items: center;

            gap: 9px;

            margin:
                5px 0 20px;

            color: #a9adbd;

            font-size: 13px;
        }


        .remember input {

            width: 17px;
            height: 17px;

            accent-color: #6366f1;
        }


        /* =====================================================
           BOTONES
        ===================================================== */

        .btn {

            width: 100%;

            height: 52px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 800;
        }


        .btn-login {

            border: none;

            color: #ffffff;

            background:
                linear-gradient(
                    90deg,
                    #8b5cf6,
                    #276cff
                );

            box-shadow:
                0 8px 25px
                rgba(93,45,255,.25);
        }


        .btn-login:hover {

            box-shadow:
                0 10px 30px
                rgba(93,45,255,.40);
        }


        .btn-login:disabled {

            opacity: .6;

            cursor: wait;
        }


        .btn-config {

            margin-top: 12px;

            border:
                1px solid #34374e;

            color: #e1e3eb;

            background: #111320;
        }


        .btn-config:hover {

            border-color: #6366f1;
        }


        .status {

            min-height: 22px;

            margin-top: 12px;

            text-align: center;

            font-size: 12px;
        }


        .version {

            margin-top: 28px;

            text-align: center;

            color: #666a7c;

            font-size: 11px;
        }


        /* =====================================================
           APLICACIÓN
        ===================================================== */

        #appPage {

            display: none;

            width: 100%;

            height: 100vh;

            background: #080912;
        }


        /* =====================================================
           BARRA SUPERIOR
        ===================================================== */

        .topbar {

            height: 70px;

            display: flex;

            align-items: center;

            padding: 0 25px;

            background: #0d0f1c;

            border-bottom:
                1px solid #25283b;
        }


        .brand {

            min-width: 220px;

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .brand-symbol {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: 900;

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #22d3ee
                );
        }


        .brand-text {

            font-size: 19px;

            font-weight: 800;
        }


        .brand-text span {

            color: #8b5cf6;
        }


        .topbar-title {

            flex: 1;

            text-align: center;

            font-size: 17px;

            font-weight: 700;
        }


        .top-actions {

            min-width: 220px;

            display: flex;

            justify-content: flex-end;

            gap: 10px;
        }


        .top-button {

            padding:
                9px 13px;

            border:
                1px solid #30344a;

            border-radius: 7px;

            color: #dfe2ec;

            background: #151827;
        }


        .top-button:hover {

            border-color: #6366f1;
        }


        /* =====================================================
           CONTENIDO
        ===================================================== */

        .main {

            height:
                calc(100vh - 70px);

            display: flex;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            width: 240px;

            flex-shrink: 0;

            padding:
                20px 14px;

            overflow-y: auto;

            background: #0b0d17;

            border-right:
                1px solid #25283b;
        }


        .sidebar-title {

            padding:
                8px 12px;

            color: #777d91;

            font-size: 11px;

            font-weight: 700;

            text-transform: uppercase;
        }


        .category {

            width: 100%;

            padding:
                13px 14px;

            margin-bottom: 5px;

            border: none;

            border-radius: 7px;

            text-align: left;

            color: #b8bdce;

            background: transparent;

            font-size: 13px;
        }


        .category:hover {

            background: #171a2a;

            color: #ffffff;
        }


        .category.active {

            background:
                linear-gradient(
                    90deg,
                    rgba(154,45,255,.28),
                    rgba(39,108,255,.10)
                );

            color: #ffffff;

            border-left:
                3px solid #8b5cf6;
        }


        /* =====================================================
           CANALES
        ===================================================== */

        .content {

            flex: 1;

            min-width: 0;

            padding: 25px;

            overflow-y: auto;
        }


        .content-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 20px;
        }


        .content-title {

            font-size: 22px;

            font-weight: 800;
        }


        .channel-count {

            color: #777d91;

            font-size: 12px;
        }


        .channels {

            display: grid;

            grid-template-columns:
                repeat(
                    auto-fill,
                    minmax(190px, 1fr)
                );

            gap: 15px;
        }


        /* =====================================================
           TARJETA CANAL
        ===================================================== */

        .channel {

            width: 100%;
            text-align: left;
            color: inherit;
            font: inherit;
            cursor: pointer;

            -webkit-appearance: none;
            appearance: none;
            min-height: 150px;

            padding: 15px;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            border:
                1px solid #272a3d;

            border-radius: 10px;

            background: #111421;

            transition:
                transform .2s,
                border-color .2s,
                background .2s;
        }


        .channel:hover {

            transform:
                translateY(-2px);

            border-color:
                #6366f1;

            background:
                #171a2a;
        }


        .channel:focus {

            outline:
                2px solid #8b5cf6;

            outline-offset: 2px;
        }


        .channel-logo {

            width: 60px;
            height: 60px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 10px;

            border-radius: 7px;

            overflow: hidden;

            background: #080a12;
        }


        .channel-logo img {

            width: 100%;
            height: 100%;

            object-fit: contain;
        }


        .channel-name {

            font-size: 13px;

            font-weight: 700;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .channel-play {

            margin-top: 8px;

            color: #8b5cf6;

            font-size: 11px;

            font-weight: 700;
        }


        /* =====================================================
           ESTADOS
        ===================================================== */

        .loading {

            padding: 50px;

            text-align: center;

            color: #85899a;

            font-size: 14px;
        }


        .empty {

            padding: 50px;

            text-align: center;

            color: #777d91;
        }


        /* =====================================================
           REPRODUCTOR
        ===================================================== */

        #playerPage {

            display: none;

            position: fixed;

            inset: 0;

            z-index: 2147483647;

            background: #03040a;
        }


        .player-header {

            height: 70px;

            display: flex;

            align-items: center;

            padding: 0 25px;

            background: #0d0f1c;

            border-bottom:
                1px solid #25283b;
        }


        .player-back {

            padding:
                10px 16px;

            border:
                1px solid #34374e;

            border-radius: 7px;

            color: #ffffff;

            background: #151827;

            font-weight: 700;
        }


        .player-fullscreen {
            margin-left: 18px; padding: 12px 18px; border: 1px solid #6366f1;
            border-radius: 8px; color: #fff; background: linear-gradient(110deg, #8b5cf6, #4269e8, #22b8cf);
            font-size: 15px; font-weight: 800;
        }
        .player-fullscreen:focus { outline: 3px solid #fff; outline-offset: 3px; }
        .video-wrapper:fullscreen, .video-wrapper:-webkit-full-screen {
            width: 100vw !important; height: 100vh !important; max-width: none;
            aspect-ratio: auto; border-radius: 0;
        }
        .player-back:hover {

            border-color: #6366f1;
        }


        .player-title {

            flex: 1;

            margin-left: 20px;

            font-size: 18px;

            font-weight: 800;
        }


        .player-container {

            width: 100%;

            height:
                calc(100vh - 70px);

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 25px;
        }


        .video-wrapper {

            position: relative;

            width: 100%;

            max-width: 1400px;

            height: 60vh;

            aspect-ratio: 16 / 9;

            background: #000000;

            border-radius: 8px;

            overflow: hidden;

            box-shadow:
                0 20px 80px
                rgba(0,0,0,.7);
        }


        .video-wrapper video {

            width: 100%;

            height: 100%;

            display: block;

            object-fit: contain;

            background: #000000;
        }


        .player-loading {

            position: absolute;

            inset: 0;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            gap: 15px;

            background:
                rgba(0,0,0,.65);

            color: #dddddd;

            pointer-events: none;
        }


        .player-start-button {
            pointer-events: auto; border: 0; border-radius: 10px; padding: 16px 28px;
            color: #fff; background: linear-gradient(110deg, #8b5cf6, #4f6fe8, #22b8cf);
            font-size: 20px; font-weight: 800;
        }
        .player-start-button:focus { outline: 3px solid #fff; outline-offset: 3px; }
        .spinner {

            width: 38px;

            height: 38px;

            border:
                4px solid #333333;

            border-top-color:
                #8b5cf6;

            border-radius: 50%;

            animation:
                spin .8s linear infinite;
        }


        @keyframes spin {

            to {
                transform: rotate(360deg);
            }

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (min-width: 1000px) and (min-height: 600px) {

            #loginPage {
                justify-content: center;
                padding: 32px;
                box-sizing: border-box;
            }

            .login-container {
                width: 92vw;
                max-width: 1100px;
                min-height: 560px;
                margin-left: 0;
                padding: 56px 72px;
                box-sizing: border-box;
                display: grid;
                grid-template-columns: minmax(260px, .85fr) minmax(420px, 1.15fr);
                column-gap: 72px;
                row-gap: 10px;
                align-content: center;
                align-items: center;
            }

            .login-container > .logo {
                grid-column: 1;
                grid-row: 1 / span 8;
                margin: 0;
            }

            .brand-logo-login { width: 100%; max-width: 440px; }



            .login-container > :not(.logo) {
                grid-column: 2;
                width: 100%;
                max-width: 560px;
                justify-self: center;
            }

            .logo-icon {
                width: 96px;
                height: 96px;
                font-size: 52px;
            }

            .logo-name {
                font-size: 40px;
            }

            .logo-iptv {
                font-size: 30px;
            }

            .login-title {
                margin-bottom: 8px;
                font-size: 26px;
            }

            .field {
                margin-bottom: 12px;
            }

            .field label {
                font-size: 17px;
            }

            .input-container {
                height: 64px;
            }

            .input-container input {
                font-size: 21px;
            }

            .remember {
                font-size: 17px;
            }

            .btn {
                min-height: 58px;
                font-size: 18px;
            }

            .version {
                font-size: 14px;
            }

        }
        @media(max-width: 800px) {

            .sidebar {

                width: 190px;
            }


            .brand {

                min-width: auto;
            }


            .brand-text {

                display: none;
            }


            .topbar-title {

                font-size: 14px;
            }


            .top-actions {

                min-width: auto;
            }


            .content {

                padding: 15px;
            }

        }


        @media(max-width: 600px) {

            .login-container {

                width: 90%;

                margin-left: 0;
            }


            #loginPage {

                justify-content: center;
            }


            .sidebar {

                width: 160px;
            }

        }

            .brand-logo-login { display:block; width:100%; max-width:470px; height:auto; }
        .brand-logo-top { display:block; width:210px; height:auto; max-height:52px; object-fit:contain; object-position:left center; }

        /* Diseño TV: filtros y lista a la izquierda, vista previa a la derecha. */
        .main {
            height: calc(100vh - 70px);
            display: grid;
            grid-template-columns: minmax(320px, 34vw) minmax(0, 1fr);
            grid-template-rows: 112px minmax(0, 1fr);
            overflow: hidden;
        }
        .sidebar {
            grid-column: 1; grid-row: 1; width: auto; min-width: 0;
            padding: 8px 10px; display: flex; flex-wrap: wrap; align-content: flex-start;
            gap: 4px; overflow-y: auto; border-right: 0; border-bottom: 1px solid #25283b;
        }
        .sidebar-title { width: 100%; padding: 2px 6px; }
        .category { width: auto; max-width: 100%; padding: 7px 9px; margin: 0; }
        #categories { width: 100%; display: flex; flex-wrap: wrap; gap: 4px; }
        .content {
            grid-column: 1; grid-row: 2; min-width: 0; min-height: 0; padding: 10px;
            display: flex; flex-direction: column; overflow: hidden;
        }
        .content-header { margin-bottom: 8px; }
        .content-title { font-size: 18px; }
        .channels {
            flex: 1; min-height: 0; display: flex; flex-direction: column; gap: 6px;
            overflow-y: auto; padding: 3px;
        }
        .channel {
            min-height: 58px; flex-direction: row; align-items: center; justify-content: flex-start;
            gap: 10px; padding: 7px 10px;
        }
        .channel > div:first-child {
            min-width: 0; flex: 1; display: flex; align-items: center; gap: 10px;
        }
        .channel-logo { width: 42px; height: 42px; flex: 0 0 42px; margin: 0; }
        .channel-name { min-width: 0; white-space: normal; }
        .channel-play { margin: 0; white-space: nowrap; }
        .channel.selected { border-color: #8b5cf6; background: #19182c; }
        #playerPage {
            grid-column: 2; grid-row: 1 / span 2; position: relative; inset: auto; z-index: auto;
            width: 100%; height: 100%; min-width: 0; min-height: 0; display: flex;
            flex-direction: column; background: #03040a;
        }
        .player-header { min-height: 60px; height: auto; flex: 0 0 auto; padding: 8px 14px; }
        .player-title { margin-left: 12px; font-size: 16px; }
        .player-fullscreen { margin-left: 10px; padding: 10px 14px; }
        .player-container {
            flex: 1; min-width: 0; min-height: 0; width: 100%; height: auto; padding: 14px;
        }
        .video-wrapper { max-width: none; }
        .player-loading.idle { background: rgba(0, 0, 0, .18); }
        .player-loading.idle .spinner { display: none; }
        .player-back:disabled { opacity: .45; }

        @media (max-width: 760px) {
            .main {
                grid-template-columns: minmax(0, 1fr);
                grid-template-rows: auto minmax(210px, 42vh) minmax(0, 1fr);
            }
            .sidebar { grid-column: 1; grid-row: 1; max-height: 100px; }
            .content { grid-column: 1; grid-row: 3; }
            #playerPage { grid-column: 1; grid-row: 2; }
            .player-header { min-height: 42px; padding: 4px 8px; }
            .player-title { font-size: 14px; }
            .player-fullscreen { margin-left: 6px; padding: 7px 9px; font-size: 12px; }
            .player-container { padding: 5px; }
            .channel { min-height: 48px; }
            .channel-logo { width: 34px; height: 34px; flex-basis: 34px; }
        }</style>
</head>


<body>


<!-- =========================================================
     LOGIN
========================================================== -->

<div id="loginPage">

    <div class="login-container">


        <div class="logo">
            <img class="brand-logo-login" src="/fibratec-logo.svg?v=1.1" alt="FIBRATEC Soluciones Internet + TV">
        </div>
        <div class="login-title">
            Ingresa tus credenciales
        </div>


        <div class="field">

            <label for="username">
                Usuario
            </label>

            <div class="input-container">

                <div class="input-icon">
                    👤
                </div>

                <input
                    id="username"
                    type="text"
                    placeholder="Tu usuario"
                    autocomplete="username"
                >

            </div>

        </div>


        <div class="field">

            <label for="password">
                Contraseña
            </label>

            <div class="input-container">

                <div class="input-icon">
                    🔒
                </div>

                <input
                    id="password"
                    type="password"
                    placeholder="Tu contraseña"
                    autocomplete="current-password"
                >

                <button
                    type="button"
                    class="password-button"
                    id="showPassword"
                >
                    👁
                </button>

            </div>

        </div>


        <label class="remember">

            <input
                type="checkbox"
                id="remember"
            >

            Recordar usuario

        </label>


        <button
            type="button"
            class="btn btn-login"
            id="loginButton"
        >
            CONECTAR
        </button>


        <button
            type="button"
            class="btn btn-config"
            id="configButton"
        >
            ⚙ &nbsp; CONFIGURACIÓN
        </button>


        <div
            class="status"
            id="status"
        ></div>


        <div class="version">
            FIBRATEC IPTV v1.1
        </div>

    </div>

</div>


<!-- =========================================================
     APLICACIÓN PRINCIPAL
========================================================== -->

<div id="appPage">


    <header class="topbar">

        <div class="brand">
            <img class="brand-logo-top" src="/fibratec-logo.svg?v=1.1" alt="FIBRATEC Soluciones Internet + TV">
        </div>
        <div class="topbar-title">
            TV EN VIVO
        </div>


        <div class="top-actions">

            <button
                class="top-button"
                id="logoutButton"
            >
                SALIR
            </button>

        </div>

    </header>


    <div class="main">


        <!-- =================================================
             CATEGORÍAS
        ================================================== -->

        <aside class="sidebar">

            <div class="sidebar-title">
                Categorías
            </div>


            <button
                class="category active"
                id="allChannels"
            >
                📺 Todos los canales
            </button>


            <div id="categories">

                <div class="loading">
                    Cargando categorías...
                </div>

            </div>

        </aside>


        <!-- =================================================
             CANALES
        ================================================== -->

        <section class="content">

            <div class="content-header">

                <div class="content-title">
                    Canales
                </div>

                <div
                    class="channel-count"
                    id="channelCount"
                >
                    Cargando...
                </div>

            </div>


            <div
                class="channels"
                id="channels"
            >

                <div class="loading">
                    Cargando canales...
                </div>

            </div>

        </section>

        <div id="playerPage">


    <div class="player-header">

        <button
            id="backToChannels"
            class="player-back"
        >
            ■ DETENER
        </button>


        <div
            id="playerTitle"
            class="player-title"
        >
            TV EN VIVO
        </div>

        <button id="fullscreenButton" class="player-fullscreen" type="button">⛶ PANTALLA COMPLETA</button>


    </div>


    <div class="player-container">

        <div class="video-wrapper">


            <video
                id="videoPlayer"
                controls
                playsinline
                autoplay
            ></video>


            <div
                id="playerLoading"
                class="player-loading idle"
            >

                <div class="spinner"></div>


                <div id="playerStatus">
                    Selecciona un canal de la lista para verlo aquí.
                </div>
                    <button id="playerStartButton" class="player-start-button" type="button" style="display:none">▶ REPRODUCIR</button>


            </div>

        </div>

    </div>

</div>

    </div>

</div>


<!-- =========================================================
     REPRODUCTOR
========================================================== -->

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<script>

/*
|--------------------------------------------------------------------------
| SESIÓN
|--------------------------------------------------------------------------
*/

let currentUsername = '';

let currentPassword = '';

let allChannels = [];

let categories = [];

let currentStreamUrl = '';
let currentStreamId = null;
let currentCompatibilityToken = null;
let compatibilityAttempted = false;

let hlsPlayer = null;

let playbackRequestId = 0;

let lastFocusedChannel = null;
let nativeHlsActive = false;
let nativeAttempted = false;
let hlsAttempted = false;
let hlsMediaRecoveryAttempted = false;
let playbackEngine = "";
let videoFrameWatchdog = null;
let lastRemoteActivationAt = 0;
let lastRemoteActivationCard = null;


/*
|--------------------------------------------------------------------------
| ELEMENTOS
|--------------------------------------------------------------------------
*/

const loginPage =
    document.getElementById(
        'loginPage'
    );


const appPage =
    document.getElementById(
        'appPage'
    );


const playerPage =
    document.getElementById(
        'playerPage'
    );


const usernameInput =
    document.getElementById(
        'username'
    );


const passwordInput =
    document.getElementById(
        'password'
    );


const rememberInput =
    document.getElementById(
        'remember'
    );


const loginButton =
    document.getElementById(
        'loginButton'
    );


const statusElement =
    document.getElementById(
        'status'
    );


const categoriesContainer =
    document.getElementById(
        'categories'
    );


const channelsContainer =
    document.getElementById(
        'channels'
    );


const channelCount =
    document.getElementById(
        'channelCount'
    );


const logoutButton =
    document.getElementById(
        'logoutButton'
    );


const videoPlayer =
    document.getElementById(
        'videoPlayer'
    );


const videoWrapper = document.querySelector('.video-wrapper');

const playerTitle =
    document.getElementById(
        'playerTitle'
    );


const playerStatus =
    document.getElementById(
        'playerStatus'
    );


const playerStartButton = document.getElementById('playerStartButton');

const playerLoading =
    document.getElementById(
        'playerLoading'
    );


const backToChannels =
    document.getElementById(
        'backToChannels'
    );


const fullscreenButton = document.getElementById('fullscreenButton');

fullscreenButton.addEventListener('click', async function () {
    try {
        const activeFullscreen = document.fullscreenElement || document.webkitFullscreenElement;
        if (activeFullscreen) {
            if (document.exitFullscreen) await document.exitFullscreen();
            else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
            return;
        }
        if (videoWrapper.requestFullscreen) {
            await videoWrapper.requestFullscreen();
        } else if (videoWrapper.webkitRequestFullscreen) {
            videoWrapper.webkitRequestFullscreen();
        } else if (videoPlayer.webkitEnterFullscreen) {
            videoPlayer.webkitEnterFullscreen();
        } else {
            playerStatus.textContent = 'Usa el botón de pantalla completa de los controles del video.';
        }
    } catch (error) {
        playerStatus.textContent = 'El navegador del TV no permitió pantalla completa.';
    }
});

function updateFullscreenLabel() {
    const activeFullscreen = document.fullscreenElement || document.webkitFullscreenElement;
    fullscreenButton.textContent = activeFullscreen ? '⛶ SALIR DE PANTALLA COMPLETA' : '⛶ PANTALLA COMPLETA';
    if (!activeFullscreen) fitVideoWrapper();
}

document.addEventListener('fullscreenchange', updateFullscreenLabel);
document.addEventListener('webkitfullscreenchange', updateFullscreenLabel);
/*
|--------------------------------------------------------------------------
| RECORDAR USUARIO
|--------------------------------------------------------------------------
*/

const savedUsername =
    localStorage.getItem(
        'fibratec_username'
    );


if (savedUsername) {

    usernameInput.value =
        savedUsername;

    rememberInput.checked =
        true;
}


/*
|--------------------------------------------------------------------------
| MOSTRAR CONTRASEÑA
|--------------------------------------------------------------------------
*/

document
    .getElementById(
        'showPassword'
    )
    .addEventListener(
        'click',
        function () {

            if (
                passwordInput.type ===
                'password'
            ) {

                passwordInput.type =
                    'text';

                this.textContent =
                    '🙈';

            } else {

                passwordInput.type =
                    'password';

                this.textContent =
                    '👁';

            }

        }
    );


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

loginButton.addEventListener(
    'click',
    async function () {

        const username =
            usernameInput.value.trim();


        const password =
            passwordInput.value;


        if (!username) {

            statusElement.style.color =
                '#ff8b98';

            statusElement.textContent =
                'Ingresa tu usuario.';

            usernameInput.focus();

            return;
        }


        if (!password) {

            statusElement.style.color =
                '#ff8b98';

            statusElement.textContent =
                'Ingresa tu contraseña.';

            passwordInput.focus();

            return;
        }


        if (
            rememberInput.checked
        ) {

            localStorage.setItem(
                'fibratec_username',
                username
            );

        } else {

            localStorage.removeItem(
                'fibratec_username'
            );

        }


        loginButton.disabled =
            true;


        loginButton.textContent =
            'CONECTANDO...';


        statusElement.style.color =
            '#d7d9e5';


        statusElement.textContent =
            'Conectando con FIBRATEC IPTV...';


        try {

            const response =
                await fetch(
                    '{{ url('/login') }}',
                    {

                        method:
                            'POST',

                        headers: {

                            'Content-Type':
                                'application/json',

                            'Accept':
                                'application/json',

                            'X-CSRF-TOKEN':
                                '{{ csrf_token() }}'

                        },

                        body:
                            JSON.stringify({

                                username:
                                    username,

                                password:
                                    password

                            })

                    }
                );


            const data =
                await response.json();


            if (
                !response.ok ||
                !data.success
            ) {

                throw new Error(
                    data.message ||
                    'No se pudo iniciar sesión.'
                );
            }


            currentUsername =
                username;


            currentPassword =
                password;


            statusElement.style.color =
                '#72e7a0';


            statusElement.textContent =
                '✓ Conectado correctamente';


            setTimeout(
                async function () {

                    loginPage.style.display =
                        'none';

                    appPage.style.display =
                        'block';

                    await loadIPTV();

                },
                400
            );


        } catch (error) {

            console.error(
                error
            );


            statusElement.style.color =
                '#ff8b98';


            statusElement.textContent =
                error.message ||
                'No se pudo conectar.';


        } finally {

            loginButton.disabled =
                false;

            loginButton.textContent =
                'CONECTAR';

        }

    }
);


/*
|--------------------------------------------------------------------------
| ENTER PARA LOGIN
|--------------------------------------------------------------------------
*/

passwordInput.addEventListener(
    'keydown',
    function (event) {

        if (
            event.key === 'Enter'
        ) {

            loginButton.click();

        }

    }
);


/*
|--------------------------------------------------------------------------
| CARGAR IPTV
|--------------------------------------------------------------------------
*/

async function loadIPTV()
{

    categoriesContainer.innerHTML =
        '<div class="loading">' +
        'Cargando categorías...' +
        '</div>';


    channelsContainer.innerHTML =
        '<div class="loading">' +
        'Cargando canales...' +
        '</div>';


    try {


        /* =================================================
           CATEGORÍAS
        ================================================== */

        const categoriesResponse =
            await fetch(
                '{{ url('/live-categories') }}',
                {

                    method:
                        'POST',

                    headers: {

                        'Content-Type':
                            'application/json',

                        'Accept':
                            'application/json',

                        'X-CSRF-TOKEN':
                            '{{ csrf_token() }}'

                    },

                    body:
                        JSON.stringify({

                            username:
                                currentUsername,

                            password:
                                currentPassword

                        })

                }
            );


        const categoriesData =
            await categoriesResponse.json();


        if (
            !categoriesResponse.ok ||
            !categoriesData.success
        ) {

            throw new Error(
                categoriesData.message ||
                'No se pudieron cargar las categorías.'
            );

        }


        categories =
            Array.isArray(
                categoriesData.categories
            )
                ? categoriesData.categories
                : [];


        renderCategories();


        /* =================================================
           CANALES
        ================================================== */

        const channelsResponse =
            await fetch(
                '{{ url('/live-streams') }}',
                {

                    method:
                        'POST',

                    headers: {

                        'Content-Type':
                            'application/json',

                        'Accept':
                            'application/json',

                        'X-CSRF-TOKEN':
                            '{{ csrf_token() }}'

                    },

                    body:
                        JSON.stringify({

                            username:
                                currentUsername,

                            password:
                                currentPassword

                        })

                }
            );


        const channelsData =
            await channelsResponse.json();


        if (
            !channelsResponse.ok ||
            !channelsData.success
        ) {

            throw new Error(
                channelsData.message ||
                'No se pudieron cargar los canales.'
            );

        }


        allChannels =
            Array.isArray(
                channelsData.channels
            )
                ? channelsData.channels
                : [];


        renderChannels(
            allChannels
        );


    } catch (error) {

        console.error(
            'Error IPTV:',
            error
        );


        categoriesContainer.innerHTML =
            '<div class="empty">' +
            'Error cargando categorías.' +
            '</div>';


        channelsContainer.innerHTML =
            '<div class="empty">' +
            escapeHtml(
                error.message
            ) +
            '</div>';


        channelCount.textContent =
            'Error';

    }

}


/*
|--------------------------------------------------------------------------
| CATEGORÍAS
|--------------------------------------------------------------------------
*/

function renderCategories()
{

    categoriesContainer.innerHTML =
        '';


    if (
        !categories.length
    ) {

        categoriesContainer.innerHTML =
            '<div class="empty">' +
            'Sin categorías' +
            '</div>';

        return;
    }


    categories.forEach(
        function (category) {

            const button =
                document.createElement(
                    'button'
                );


            button.className =
                'category';


            button.textContent =
                '📁 ' +
                (
                    category.category_name ||
                    category.name ||
                    'Categoría'
                );


            button.addEventListener(
                'click',
                function () {

                    document
                        .querySelectorAll(
                            '.category'
                        )
                        .forEach(
                            function (item) {

                                item.classList.remove(
                                    'active'
                                );

                            }
                        );


                    button.classList.add(
                        'active'
                    );


                    const categoryId =
                        String(
                            category.category_id ??
                            category.id ??
                            ''
                        );


                    const filtered =
                        allChannels.filter(
                            function (channel) {

                                return String(
                                    channel.category_id ??
                                    ''
                                ) ===
                                categoryId;

                            }
                        );


                    renderChannels(
                        filtered
                    );

                }
            );


            categoriesContainer.appendChild(
                button
            );

        }
    );

}


/*
|--------------------------------------------------------------------------
| TODOS LOS CANALES
|--------------------------------------------------------------------------
*/

document
    .getElementById(
        'allChannels'
    )
    .addEventListener(
        'click',
        function () {

            document
                .querySelectorAll(
                    '.category'
                )
                .forEach(
                    function (item) {

                        item.classList.remove(
                            'active'
                        );

                    }
                );


            this.classList.add(
                'active'
            );


            renderChannels(
                allChannels
            );

        }
    );


/*
|--------------------------------------------------------------------------
| MOSTRAR CANALES
|--------------------------------------------------------------------------
*/

function renderChannels(
    channels
)
{

    channelsContainer.innerHTML =
        '';


    channelCount.textContent =
        channels.length +
        (
            channels.length === 1
                ? ' canal'
                : ' canales'
        );


    if (
        !channels.length
    ) {

        channelsContainer.innerHTML =
            '<div class="empty">' +
            'No hay canales disponibles.' +
            '</div>';

        return;
    }


    channels.forEach(
        function (channel) {

            const card =
                document.createElement(
                    'button'
                );


            card.className =
                'channel';

            card.type = 'button';





            const logo =
                channel.stream_icon ||
                channel.logo ||
                '';


            const name =
                channel.name ||
                channel.stream_display_name ||
                'Canal';


            let logoHtml =
                '';


            if (logo) {

                logoHtml =
                    '<img src="' +
                    escapeAttribute(
                        logo
                    ) +
                    '" alt="" ' +
                    'onerror="' +
                    'this.style.display=\'none\'"'
                    +
                    '>';

            }


            card.innerHTML =

                '<div>' +

                    '<div class="channel-logo">' +

                        logoHtml +

                    '</div>' +

                    '<div class="channel-name">' +

                        escapeHtml(
                            name
                        ) +

                    '</div>' +

                '</div>' +

                '<div class="channel-play">' +

                    '▶ REPRODUCIR' +

                '</div>';


            /*
            |--------------------------------------------------------------------------
            | CLICK
            |--------------------------------------------------------------------------
            */

            card.addEventListener(
                'click',
                function () {

                    card.focus();
                    lastFocusedChannel = card;
                    document.querySelectorAll('.channel.selected').forEach(function (item) { item.classList.remove('selected'); });
                    card.classList.add('selected');

                    playChannel(
                        channel
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | ENTER
            |--------------------------------------------------------------------------
            */

            // La activacion del control remoto se centraliza en el manejador global.

            channelsContainer.appendChild(
                card
            );

            if (
                /webOS|Web0S/i.test(navigator.userAgent) &&
                channelsContainer.children.length === 1
            ) {
                card.focus();
            }

        }
    );

}


/*
|--------------------------------------------------------------------------
| REPRODUCIR CANAL
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'keydown',
    function (event) {
        const keyName = (event.key || '').toLowerCase();
        let keyCode = event.keyCode || event.which;

        if (!keyCode) {
            if (keyName === 'enter' || keyName === 'accept' || keyName === 'select') keyCode = 13;
            if (keyName === 'arrowleft' || keyName === 'left') keyCode = 37;
            if (keyName === 'arrowup' || keyName === 'up') keyCode = 38;
            if (keyName === 'arrowright' || keyName === 'right') keyCode = 39;
            if (keyName === 'arrowdown' || keyName === 'down') keyCode = 40;
        }
        const active = document.activeElement;

        const isDirectionalKey =
            keyCode === 37 || keyCode === 38 || keyCode === 39 || keyCode === 40 ||
            keyName === 'arrowleft' || keyName === 'arrowup' ||
            keyName === 'arrowright' || keyName === 'arrowdown' ||
            keyName === 'left' || keyName === 'up' || keyName === 'right' || keyName === 'down';
        const isBackKey =
            keyCode === 461 || keyCode === 8 || keyCode === 27 ||
            keyName === 'back' || keyName === 'escape';

        const eventChannel = event.target && event.target.closest
            ? event.target.closest('.channel')
            : null;
        const focusedChannel = active && active.closest
            ? active.closest('.channel')
            : null;
        const channelToActivate = focusedChannel || eventChannel;

        if (
            appPage.style.display === 'block' &&
            channelToActivate &&
            !isDirectionalKey && !isBackKey
        ) {
            event.preventDefault();
            event.stopPropagation();
            const now = Date.now();
            if (lastRemoteActivationCard === channelToActivate && now - lastRemoteActivationAt < 700) return;
            lastRemoteActivationCard = channelToActivate;
            lastRemoteActivationAt = now;
            channelToActivate.click();
            return;
        }
        if (isBackKey && currentStreamUrl) {
            event.preventDefault();
            event.stopPropagation();
            const fullscreenElement = document.fullscreenElement || document.webkitFullscreenElement;
            if (fullscreenElement) {
                if (document.exitFullscreen) document.exitFullscreen();
                else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
            } else {
                stopPlayer();
            }
            return;
        }

        let direction = '';

        if (keyCode === 37 || keyName === 'arrowleft' || keyName === 'left') direction = 'left';
        if (keyCode === 38 || keyName === 'arrowup' || keyName === 'up') direction = 'up';
        if (keyCode === 39 || keyName === 'arrowright' || keyName === 'right') direction = 'right';
        if (keyCode === 40 || keyName === 'arrowdown' || keyName === 'down') direction = 'down';

        if (!direction) {
            return;
        }

        if (
            active &&
            (active.tagName === 'INPUT' || active.tagName === 'TEXTAREA') &&
            (direction === 'left' || direction === 'right')
        ) {
            return;
        }

        const selector =
            'input:not([disabled]), button:not([disabled]), a[href], ' +
            '.channel, [tabindex]:not([tabindex="-1"])';

        const candidates = Array.prototype.slice.call(
            document.querySelectorAll(selector)
        ).filter(function (element) {
            const style = window.getComputedStyle(element);
            return (
                (element.offsetWidth > 0 || element.offsetHeight > 0) &&
                style.visibility !== 'hidden'
            );
        });

        if (!candidates.length) {
            event.preventDefault();
            event.stopPropagation();
            return;
        }

        if (candidates.indexOf(active) < 0) {
            candidates[0].focus();
            event.preventDefault();
            event.stopPropagation();
            return;
        }

        const activeRect = active.getBoundingClientRect();
        const activeX = activeRect.left + activeRect.width / 2;
        const activeY = activeRect.top + activeRect.height / 2;
        let next = null;
        let bestScore = Infinity;

        candidates.forEach(function (candidate) {
            if (candidate === active) {
                return;
            }

            const rect = candidate.getBoundingClientRect();
            const dx = rect.left + rect.width / 2 - activeX;
            const dy = rect.top + rect.height / 2 - activeY;

            const primary =
                direction === 'left' ? -dx :
                direction === 'right' ? dx :
                direction === 'up' ? -dy : dy;

            const secondary =
                direction === 'left' || direction === 'right'
                    ? Math.abs(dy)
                    : Math.abs(dx);

            if (primary <= 0) {
                return;
            }

            const score = primary + secondary * 2;

            if (score < bestScore) {
                bestScore = score;
                next = candidate;
            }
        });

        if (next) {
            next.focus();
        }

        event.preventDefault();
        event.stopPropagation();
    },
    true
);

document.addEventListener('keyup', function (event) {
    if (appPage.style.display !== 'block') return;
    const active = document.activeElement;
    const channel = (active && active.closest && active.closest('.channel')) ||
        (event.target && event.target.closest && event.target.closest('.channel'));
    if (!channel) return;
    const key = (event.key || '').toLowerCase();
    const code = event.keyCode || event.which;
    if ([37, 38, 39, 40, 8, 27, 461].indexOf(code) >= 0 ||
        ['arrowleft', 'arrowright', 'arrowup', 'arrowdown', 'back', 'escape'].indexOf(key) >= 0) return;
    event.preventDefault();
    event.stopPropagation();
    const now = Date.now();
    if (lastRemoteActivationCard === channel && now - lastRemoteActivationAt < 700) return;
    lastRemoteActivationCard = channel;
    lastRemoteActivationAt = now;
    channel.click();
}, true);
async function playChannel(
    channel
)
{

    const requestId =
        ++playbackRequestId;

    const name =
        channel.name ||
        channel.stream_display_name ||
        'Canal';


    const streamId =
        channel.stream_id ??
        channel.id ??
        null;


    if (!streamId) {

        alert(
            'No se encontró el ID del canal.'
        );

        return;
    }
    stopCompatibleStream();
    currentStreamId = String(streamId);
    compatibilityAttempted = false;


    /*
    |--------------------------------------------------------------------------
    | ABRIR REPRODUCTOR
    |--------------------------------------------------------------------------
    */

    showPlayer(
        name
    );


    playerStatus.textContent =
        'Obteniendo señal...';


    try {

        const response =
            await fetch(
                '{{ url('/stream-url') }}',
                {

                    method:
                        'POST',

                    headers: {

                        'Content-Type':
                            'application/json',

                        'Accept':
                            'application/json',

                        'X-CSRF-TOKEN':
                            '{{ csrf_token() }}'

                    },

                    body:
                        JSON.stringify({

                            username:
                                currentUsername,

                            password:
                                currentPassword,

                            stream_id:
                                streamId

                        })

                }
            );


        const data =
            await response.json();


        if (requestId !== playbackRequestId) {

            return;

        }


        if (
            !response.ok ||
            !data.success
        ) {

            throw new Error(
                data.message ||
                'No se pudo obtener el stream.'
            );

        }


        currentStreamUrl =
            data.url;


        console.log(
            'URL del stream:',
            currentStreamUrl
        );


        playerStatus.textContent =
            'Conectando con el canal...';


        nativeAttempted = false;
        hlsAttempted = false;
        hlsMediaRecoveryAttempted = false;


        await startPlayer(currentStreamUrl);



    } catch (error) {

        if (requestId !== playbackRequestId) {

            return;

        }

        console.error(
            'Error del reproductor:',
            error
        );


        playerLoading.style.display =
            'flex';


        playerStatus.textContent =
            error.message ||
            'No se pudo reproducir el canal.';

    }

}


/*
|--------------------------------------------------------------------------
| MOSTRAR REPRODUCTOR
|--------------------------------------------------------------------------
*/

function fitVideoWrapper() {
    const fullscreenElement = document.fullscreenElement || document.webkitFullscreenElement;
    const inFullscreen = fullscreenElement === videoWrapper;
    const container = videoWrapper.parentElement;
    const availableWidth = inFullscreen ? window.innerWidth : Math.max(240, container.clientWidth - 24);
    const availableHeight = inFullscreen ? window.innerHeight : Math.max(135, container.clientHeight - 24);
    const width = Math.floor(Math.min(availableWidth, availableHeight * 16 / 9));
    const height = Math.floor(width * 9 / 16);
    videoWrapper.style.width = width + 'px';
    videoWrapper.style.height = height + 'px';
}

window.addEventListener('resize', fitVideoWrapper);
function showPlayer(name)
{
    playerTitle.textContent = name;
    playerStatus.textContent = 'Preparando reproducción...';
    playerLoading.classList.remove('idle');
    playerLoading.style.display = 'flex';
    fitVideoWrapper();
}


async function releaseCompatibleStream(token)
{
    if (!token) return;
    try {
        await fetch('{{ url('/compatible-stream/stop') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ token })
        });
    } catch (error) {
        console.warn('No se pudo cerrar la conversión compatible.', error);
    }
}

function stopCompatibleStream()
{
    const token = currentCompatibilityToken;
    currentCompatibilityToken = null;
    if (token) releaseCompatibleStream(token);
}

async function startCompatiblePlayback(requestId = playbackRequestId)
{
    if (compatibilityAttempted || !currentStreamId) return false;
    compatibilityAttempted = true;
    playerLoading.style.display = 'flex';
    playerStatus.textContent = 'Adaptando este canal para el navegador…';

    try {
        const response = await fetch('{{ url('/compatible-stream') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                username: currentUsername,
                password: currentPassword,
                stream_id: currentStreamId
            })
        });
        const data = await response.json();
        if (requestId !== playbackRequestId) {
            if (data.token) await releaseCompatibleStream(data.token);
            return false;
        }
        if (!response.ok || !data.success || !data.url || !data.token) {
            throw new Error(data.message || 'No se pudo adaptar el canal.');
        }

        currentCompatibilityToken = data.token;
        currentStreamUrl = data.url;
        playerStatus.textContent = 'Iniciando versión compatible…';
        await startPlayer(data.url, false, true);
        return true;
    } catch (error) {
        if (requestId === playbackRequestId) {
            console.error('Compatibilidad de canal falló:', error);
            playerLoading.style.display = 'flex';
            playerStatus.textContent = error.message || 'No se pudo preparar el video para este navegador.';
        }
        return false;
    }
}
/*
|--------------------------------------------------------------------------
| INICIAR REPRODUCTOR
|--------------------------------------------------------------------------
*/

async function startPlayer(url, forceNative = false, compatibilitySource = false)
{
    const isWebOSTv = /webOS|Web0S/i.test(navigator.userAgent);
    if (videoFrameWatchdog) {
        clearTimeout(videoFrameWatchdog);
        videoFrameWatchdog = null;
    }

    nativeHlsActive = false;
    playbackEngine = '';
    playerStartButton.style.display = 'none';

    if (hlsPlayer) {
        hlsPlayer.destroy();
        hlsPlayer = null;
    }

    videoPlayer.pause();
    videoPlayer.removeAttribute('src');
    videoPlayer.load();
    playerLoading.classList.remove('idle');
    playerLoading.style.display = 'flex';
    playerStatus.textContent = 'Conectando con el canal...';


    // La ruta HLS se elige por capacidades del navegador, no por IDs.

    if (forceNative && isWebOSTv) {
        nativeAttempted = true;
        nativeHlsActive = true;
        playbackEngine = 'native';
        videoPlayer.src = url;
        videoPlayer.load();
        try {
            await videoPlayer.play();
        } catch (error) {
            playerStatus.textContent = 'Señal lista. Pulsa reproducir para iniciar.';
            playerStartButton.style.display = 'inline-block';
            playerStartButton.focus();
        }
        return;
    }

    if (!forceNative && window.Hls && Hls.isSupported()) {
        hlsAttempted = true;
        playbackEngine = 'hlsjs';
        hlsPlayer = new Hls({ enableWorker: true, lowLatencyMode: true, backBufferLength: 30 });
        hlsPlayer.loadSource(url);
        hlsPlayer.attachMedia(videoPlayer);

        hlsPlayer.on(Hls.Events.MANIFEST_PARSED, async function () {
            playerStatus.textContent = 'Iniciando reproducción...';
            try {
                await videoPlayer.play();
            } catch (error) {
                playerStatus.textContent = 'El navegador bloqueó el inicio automático. Pulsa reproducir.';
                playerStartButton.style.display = 'inline-block';
                playerStartButton.focus();
            }
        });

        hlsPlayer.on(Hls.Events.ERROR, function (event, data) {
            console.error('HLS ERROR:', data);
            const decodeFailure = data.type === Hls.ErrorTypes.MEDIA_ERROR ||
                ['bufferAppendError', 'mediaSourceRequiresReset', 'fragParsingError'].includes(data.details);
            if (!compatibilitySource && !compatibilityAttempted && decodeFailure) {
                startCompatiblePlayback();
                return;
            }
            if (!data.fatal) return;
            if (!compatibilitySource && isWebOSTv && !nativeAttempted && currentStreamUrl) {
                nativeAttempted = true;
                playerStatus.textContent = 'Cambiando al reproductor nativo del LG...';
                startPlayer(currentStreamUrl, true);
                return;
            }
            const detail = data.details || data.type || 'error desconocido';
            const httpCode = data.response && data.response.code ? ' · HTTP ' + data.response.code : '';
            playerLoading.style.display = 'flex';
            playerStatus.textContent = 'HLS no pudo decodificar este canal: ' + detail + httpCode + '.';
        });
        return;
    }

    if (isWebOSTv || videoPlayer.canPlayType('application/vnd.apple.mpegurl')) {
        nativeAttempted = true;
        nativeHlsActive = true;
        playbackEngine = 'native';
        videoPlayer.src = url;
        videoPlayer.load();
        try {
            await videoPlayer.play();
        } catch (error) {
            playerStatus.textContent = 'Señal lista. Pulsa reproducir para iniciar.';
            playerStartButton.style.display = 'inline-block';
            playerStartButton.focus();
        }
        return;
    }

    playerStatus.textContent = 'Este dispositivo no soporta reproducción HLS.';
}
/*
|--------------------------------------------------------------------------
| VIDEO REPRODUCIENDO
|--------------------------------------------------------------------------
*/

playerStartButton.addEventListener('click', function () {
    playerStartButton.style.display = 'none';
    videoPlayer.muted = false;
    videoPlayer.play().catch(function () {
        playerStatus.textContent = 'No se pudo iniciar. Vuelve a pulsar reproducir.';
        playerStartButton.style.display = 'inline-block';
        playerStartButton.focus();
    });
});

videoPlayer.addEventListener('playing', function () {
    playerLoading.style.display = 'none';
    playerStartButton.style.display = 'none';

    if (videoFrameWatchdog) clearTimeout(videoFrameWatchdog);
    videoFrameWatchdog = setTimeout(function () {
        if (appPage.style.display !== 'block' || !currentStreamUrl || videoPlayer.currentTime < 2 || videoPlayer.videoWidth > 0) return;

        if (playbackEngine === 'hlsjs' && /webOS|Web0S/i.test(navigator.userAgent) && !nativeAttempted) {
            nativeAttempted = true;
            playerStatus.textContent = 'Cambiando al reproductor nativo de LG...';
            startPlayer(currentStreamUrl, true);
            return;
        }

        if (playbackEngine === 'native' && !hlsAttempted && window.Hls && Hls.isSupported()) {
            hlsAttempted = true;
            nativeHlsActive = false;
            playerStatus.textContent = 'Probando el reproductor HLS alternativo...';
            startPlayer(currentStreamUrl, false);
            return;
        }

        playerLoading.style.display = 'flex';
        playerStatus.textContent = 'El canal entrega audio, pero el televisor no está mostrando cuadros de video.';
    }, 6000);
});

videoPlayer.addEventListener('error', function () {
    if (!videoPlayer.currentSrc) return;
    playerLoading.style.display = 'flex';
    const mediaErrorCode = videoPlayer.error ? videoPlayer.error.code : 0;
    if (mediaErrorCode === 3 && !compatibilityAttempted && currentStreamId) {
        startCompatiblePlayback();
        return;
    }
    if (mediaErrorCode === 3 && playbackEngine === 'hlsjs' && hlsPlayer && !hlsMediaRecoveryAttempted) {
        hlsMediaRecoveryAttempted = true;
        playerStatus.textContent = 'El navegador rechazó un fragmento de video. Intentando recuperarlo...';
        try { hlsPlayer.recoverMediaError(); return; }
        catch (error) { console.error('No se pudo recuperar el error de video:', error); }
    }

    if (nativeHlsActive && !hlsAttempted && window.Hls && Hls.isSupported() && currentStreamUrl) {
        hlsAttempted = true;
        nativeHlsActive = false;
        playerStatus.textContent = 'Cambiando a compatibilidad HLS alternativa...';
        startPlayer(currentStreamUrl, false);
        return;
    }

    if (playbackEngine === 'hlsjs' && /webOS|Web0S/i.test(navigator.userAgent) && !nativeAttempted && currentStreamUrl) {
        nativeAttempted = true;
        playerStatus.textContent = 'Cambiando al reproductor nativo de LG...';
        startPlayer(currentStreamUrl, true);
        return;
    }

    const code = videoPlayer.error ? videoPlayer.error.code : 'desconocido';
    const mediaErrorText = { 1: 'reproducción cancelada', 2: 'error de red', 3: 'el navegador no pudo decodificar el video', 4: 'formato de video no compatible' }[code] || 'error del reproductor';
    playerStatus.textContent = 'El reproductor no pudo mostrar el video: ' + mediaErrorText + ' (error ' + code + ').';
});

/*
|--------------------------------------------------------------------------
| VOLVER A CANALES
|--------------------------------------------------------------------------
*/

backToChannels.addEventListener(
    'click',
    function () {

        stopPlayer();

    }
);


/*
|--------------------------------------------------------------------------
| DETENER REPRODUCTOR
|--------------------------------------------------------------------------
*/

function stopPlayer()
{
    playbackRequestId++;
    stopCompatibleStream();
    currentStreamId = null;
    compatibilityAttempted = false;
    if (hlsPlayer) {
        hlsPlayer.destroy();
        hlsPlayer = null;
    }
    if (videoFrameWatchdog) {
        clearTimeout(videoFrameWatchdog);
        videoFrameWatchdog = null;
    }
    videoPlayer.pause();
    videoPlayer.removeAttribute('src');
    videoPlayer.load();
    currentStreamUrl = '';
    nativeAttempted = false;
    hlsAttempted = false;
    hlsMediaRecoveryAttempted = false;
    playbackEngine = '';
    playerTitle.textContent = 'TV EN VIVO';
    playerLoading.classList.add('idle');
    playerLoading.style.display = 'flex';
    playerStatus.textContent = 'Selecciona un canal de la lista para verlo aquí.';
    if (lastFocusedChannel && document.body.contains(lastFocusedChannel)) {
        lastFocusedChannel.focus();
    }
}

/*
|--------------------------------------------------------------------------
| CONFIGURACIÓN
|--------------------------------------------------------------------------
*/

document
    .getElementById(
        'configButton'
    )
    .addEventListener(
        'click',
        function () {

            alert(
                'FIBRATEC IPTV\n\n' +
                'Servidor configurado correctamente.'
            );

        }
    );


/*
|--------------------------------------------------------------------------
| SEGURIDAD
|--------------------------------------------------------------------------
*/

function escapeHtml(
    value
)
{

    return String(value)

        .replace(
            /&/g,
            '&amp;'
        )

        .replace(
            /</g,
            '&lt;'
        )

        .replace(
            />/g,
            '&gt;'
        )

        .replace(
            /"/g,
            '&quot;'
        )

        .replace(
            /'/g,
            '&#039;'
        );

}


function escapeAttribute(
    value
)
{

    return String(value)

        .replace(
            /"/g,
            '&quot;'
        )

        .replace(
            /'/g,
            '&#039;'
        );

}

</script>

</body>
</html>