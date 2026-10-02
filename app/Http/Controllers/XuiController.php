<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process as SymfonyProcess;

class XuiController extends Controller
{
    private string $xuiServer;

    public function __construct()
    {
        // Leer desde .env (ej: XUI_SERVER=http://TU_SERVIDOR)
        $this->xuiServer = rtrim(env('XUI_SERVER', 'http://30.255.255.13'), '/');
    }

    private function normalizeChannelSourceLabel(array $channel): string
    {
        $candidates = [
            $channel['stream_type'] ?? null,
            $channel['source_type'] ?? null,
            $channel['type'] ?? null,
            $channel['container'] ?? null,
            $channel['source'] ?? null,
            $channel['category_name'] ?? null,
            $channel['name'] ?? null,
            $channel['channel_name'] ?? null,
        ];

        $source = '';

        foreach ($candidates as $candidate) {
            if (is_scalar($candidate)) {
                $value = trim((string) $candidate);
                if ($value !== '') {
                    $source .= ' ' . $value;
                }
            }
        }

        return strtolower($source);
    }

    private function isNonPlayableChannel(array $channel): bool
    {
        if (!is_array($channel)) {
            return true;
        }

        $sourceText = $this->normalizeChannelSourceLabel($channel);

        $blockedTokens = [
            'astra',
            'satellite',
            'parabolic',
            'parabólica',
            'dvb',
            'dvb-s',
            'dvb_s',
            'sat',
            'satelite',
            'satelital',
            'satelite',
            'tuner',
            'external',
            'antena',
        ];

        foreach ($blockedTokens as $token) {
            if (str_contains($sourceText, $token)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Intento de login: consulta user_info en la API XUI/Xtream.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $username = $request->username;
        $password = $request->password;

        try {
            $response = Http::timeout(10)->get($this->xuiServer . '/player_api.php', [
                'username' => $username,
                'password' => $password,
                'action' => 'get_user_info',
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo conectar con el servidor IPTV (login).',
                ], 502);
            }

            $data = $response->json();

            if (!isset($data['user_info']) || (($data['user_info']['auth'] ?? 0) != 1)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario o contraseña incorrectos.',
                ], 401);
            }

            return response()->json([
                'success' => true,
                'message' => 'Conectado correctamente.',
                'user' => $data['user_info'],
            ]);
        } catch (\Throwable $e) {
            Log::error('XUI login error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'No se pudo establecer conexión con el servidor IPTV.',
            ], 500);
        }
    }

    /**
     * Obtener categorías en vivo.
     */
    public function liveCategories(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        try {
            $response = Http::timeout(15)->get($this->xuiServer . '/player_api.php', [
                'username' => $request->username,
                'password' => $request->password,
                'action' => 'get_live_categories',
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudieron obtener las categorías.',
                ], 502);
            }

            return response()->json([
                'success' => true,
                'categories' => $response->json(),
            ]);
        } catch (\Throwable $e) {
            Log::error('XUI liveCategories error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error consultando las categorías.',
            ], 500);
        }
    }

    /**
     * Obtener lista de canales en vivo.
     */
    public function liveStreams(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        try {
            $response = Http::timeout(20)->get($this->xuiServer . '/player_api.php', [
                'username' => $request->username,
                'password' => $request->password,
                'action' => 'get_live_streams',
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudieron obtener los canales.',
                ], 502);
            }

            $channels = $response->json();

            if (!is_array($channels)) {
                return response()->json([
                    'success' => false,
                    'message' => 'XUI no devolvió una lista válida de canales.',
                ], 502);
            }

            $playableChannels = array_values(array_filter($channels, function ($channel) {
                return is_array($channel) && !$this->isNonPlayableChannel($channel);
            }));

            return response()->json([
                'success' => true,
                'channels' => $playableChannels,
                'count' => count($playableChannels),
            ]);
        } catch (\Throwable $e) {
            Log::error('XUI liveStreams error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error consultando los canales.',
            ], 500);
        }
    }

    /**
     * Obtener una URL reproducible para un canal específico.
     */
    public function streamUrl(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'stream_id' => ['required'],
        ]);

        $username = $request->username;
        $password = $request->password;
        $streamIdRaw = $request->stream_id;
        $streamId = is_numeric($streamIdRaw) ? (int) $streamIdRaw : $streamIdRaw;

        try {
            $response = Http::timeout(20)->get($this->xuiServer . '/player_api.php', [
                'username' => $username,
                'password' => $password,
                'action' => 'get_live_streams',
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudieron consultar los canales de XUI.',
                ], 502);
            }

            $channels = $response->json();

            if (!is_array($channels)) {
                return response()->json([
                    'success' => false,
                    'message' => 'XUI no devolvió una lista válida de canales.',
                ], 502);
            }

            $channel = collect($channels)->first(function ($item) use ($streamId) {
                if (!is_array($item)) {
                    return false;
                }

                $candidates = [
                    $item['stream_id'] ?? null,
                    $item['id'] ?? null,
                    $item['num'] ?? null,
                ];

                foreach ($candidates as $candidate) {
                    if ($candidate === null) {
                        continue;
                    }

                    if (
                        is_numeric($candidate)
                        && is_numeric($streamId)
                        && (int) $candidate === (int) $streamId
                    ) {
                        return true;
                    }

                    if ((string) $candidate === (string) $streamId) {
                        return true;
                    }
                }

                return false;
            });

            if (!$channel) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el canal en XUI.',
                    'stream_id' => $streamIdRaw,
                ], 404);
            }

            if ($this->isNonPlayableChannel($channel)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Este canal no es compatible con el player HTTP actual. Requiere origen Astra/Parabólica o DVB.',
                    'source_type' => strtolower((string) ($channel['stream_type'] ?? $channel['source_type'] ?? $channel['type'] ?? 'unknown')),
                    'channel' => $channel['name'] ?? null,
                ], 400);
            }

            $possibleKeys = [
                'stream_url',
                'url',
                'stream_source',
                'stream_uri',
                'playlist_url',
            ];

            foreach ($possibleKeys as $key) {
                if (
                    !empty($channel[$key])
                    && filter_var($channel[$key], FILTER_VALIDATE_URL)
                ) {
                    $originalUrl = $channel[$key];

                    return response()->json([
                        'success' => true,
                        'url' => url('/proxy') . '?url=' . urlencode($originalUrl),
                        'original' => $originalUrl,
                        'note' => 'URL proxificada para evitar CORS.',
                    ]);
                }
            }

            $candidates = [
                "{$this->xuiServer}/live/{$username}/{$password}/{$streamId}.m3u8",
                "{$this->xuiServer}/live/{$username}/{$password}/{$streamId}.ts",
                "{$this->xuiServer}/get.php?username={$username}&password={$password}&type=m3u",
                "{$this->xuiServer}/get.php?username={$username}&password={$password}&type=mpegts&stream={$streamId}",
            ];

            foreach ($candidates as $candidate) {
                try {
                    $ok = false;

                    try {
                        $head = Http::timeout(6)->head($candidate);
                        $ok = $head->ok();
                    } catch (\Throwable $e) {
                        $small = Http::timeout(6)->get($candidate);
                        $ok = $small->ok();
                    }

                    if ($ok) {
                        return response()->json([
                            'success' => true,
                            'url' => url('/proxy') . '?url=' . urlencode($candidate),
                            'original' => $candidate,
                            'note' => 'URL construida y proxificada.',
                        ]);
                    }
                } catch (\Throwable $e) {
                    Log::warning(
                        'XUI candidate check failed: ' . $e->getMessage()
                    );
                }
            }

            $m3uUrl = "{$this->xuiServer}/get.php?username={$username}&password={$password}&type=m3u";

            return response()->json([
                'success' => true,
                'url' => url('/proxy') . '?url=' . urlencode($m3uUrl),
                'original' => $m3uUrl,
                'note' => 'Se devuelve la M3U como fallback (proxificada).',
            ]);
        } catch (\Throwable $e) {
            Log::error('XUI streamUrl error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error consultando XUI.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Prepara una salida HLS compatible solo cuando el reproductor del cliente
     * no puede decodificar directamente el canal.
     */
    public function compatibleStream(Request $request)
    {
        @set_time_limit(60);
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:128'],
            'password' => ['required', 'string', 'max:256'],
            'stream_id' => ['required', 'integer', 'min:1'],
        ]);

        $username = $validated['username'];
        $password = $validated['password'];
        $streamId = (int) $validated['stream_id'];

        try {
            $auth = Http::timeout(10)->get($this->xuiServer . '/player_api.php', [
                'username' => $username,
                'password' => $password,
                'action' => 'get_user_info',
            ]);

            $userInfo = $auth->json('user_info');
            if (!$auth->successful() || !is_array($userInfo) || (int) ($userInfo['auth'] ?? 0) !== 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'La sesión IPTV ya no es válida. Vuelve a iniciar sesión.',
                ], 401);
            }

            $response = Http::timeout(20)->get($this->xuiServer . '/player_api.php', [
                'username' => $username,
                'password' => $password,
                'action' => 'get_live_streams',
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudieron consultar los canales del servidor.',
                ], 502);
            }

            $channels = $response->json();
            $channel = null;

            if (is_array($channels)) {
                $channel = collect($channels)->first(function ($item) use ($streamId) {
                    if (!is_array($item)) {
                        return false;
                    }

                    $values = [
                        $item['stream_id'] ?? null,
                        $item['id'] ?? null,
                        $item['num'] ?? null,
                    ];

                    foreach ($values as $value) {
                        if ($value === null) {
                            continue;
                        }

                        if ((is_numeric($value) && (int) $value === $streamId) || (string) $value === (string) $streamId) {
                            return true;
                        }
                    }

                    return false;
                });
            }

            if (!$channel) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el canal solicitado.',
                ], 404);
            }

            if ($this->isNonPlayableChannel($channel)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Este canal no es compatible con el player HTTP actual. Requiere origen Astra/Parabólica o DVB.',
                    'source_type' => strtolower((string) ($channel['stream_type'] ?? $channel['source_type'] ?? $channel['type'] ?? 'unknown')),
                    'channel' => $channel['name'] ?? null,
                ], 400);
            }

            $ffmpeg = env('FFMPEG_BINARY') ?: base_path(
                'node_modules/ffmpeg-static/ffmpeg' . (DIRECTORY_SEPARATOR === '\\' ? '.exe' : '')
            );

            if (!is_file($ffmpeg)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró FFmpeg en la aplicación. Ejecuta npm install en la carpeta del proyecto y reinicia Laravel.',
                ], 503);
            }

            $this->cleanupIdleCompatibleStreams();

            $token = bin2hex(random_bytes(32));
            $directory = storage_path('app/compat-streams/' . $token);
            File::ensureDirectoryExists($directory);
            File::put($directory . DIRECTORY_SEPARATOR . 'last_access', (string) time());

            $sourceUrl = $this->xuiServer . '/live/' . rawurlencode($username) . '/' . rawurlencode($password) . '/' . $streamId . '.m3u8';
            $playlist = $directory . DIRECTORY_SEPARATOR . 'index.m3u8';
            $segmentPattern = $directory . DIRECTORY_SEPARATOR . 'segment_%09d.ts';

            $command = [
                $ffmpeg,
                '-hide_banner', '-loglevel', 'quiet', '-nostats', '-nostdin',
                '-user_agent', 'Mozilla/5.0 FIBRATEC-IPTV',
                '-i', $sourceUrl,
                '-map', '0:v:0', '-map', '0:a:0?',
                '-c:v', 'libx264', '-preset', 'ultrafast', '-tune', 'zerolatency',
                '-profile:v', 'baseline', '-pix_fmt', 'yuv420p',
                '-g', '120', '-keyint_min', '120', '-sc_threshold', '0',
                '-c:a', 'aac', '-b:a', '128k', '-ac', '2', '-ar', '48000',
                '-f', 'hls', '-hls_time', '4', '-hls_list_size', '8',
                '-hls_flags', 'delete_segments+independent_segments+omit_endlist',
                '-hls_delete_threshold', '3', '-hls_segment_filename', $segmentPattern,
                $playlist,
            ];

            try {
                $process = new SymfonyProcess($command, $directory, null, null, null);
                if (DIRECTORY_SEPARATOR === '\\') {
                    // Deja vivo el proceso al terminar esta petición web.
                    $process->setOptions(['create_new_console' => true]);
                }
                $process->start();
                $pid = $process->getPid();
                if (!$pid) {
                    throw new \RuntimeException('FFmpeg no inició un proceso.');
                }
                File::put($directory . DIRECTORY_SEPARATOR . 'pid', (string) $pid);
            } catch (\Throwable $e) {
                File::deleteDirectory($directory);
                Log::error('No se pudo iniciar FFmpeg para compatibilidad IPTV.', ['stream_id' => $streamId, 'error' => $e->getMessage()]);
                return response()->json([
                    'success' => false,
                    'message' => 'La aplicación no pudo iniciar el reproductor compatible.',
                ], 502);
            }

            // Espera a que FFmpeg escriba la playlist antes de entregarla al TV.
            $deadline = microtime(true) + 18;
            while (microtime(true) < $deadline) {
                clearstatcache(true, $playlist);
                if (is_file($playlist) && filesize($playlist) > 0) {
                    return response()->json([
                        'success' => true,
                        'url' => url('/compat-stream/' . $token . '/index.m3u8'),
                        'token' => $token,
                        'message' => 'Señal adaptada para el navegador.',
                    ]);
                }
                usleep(250000);
            }

            $this->terminateCompatibleProcess((int) @file_get_contents($directory . DIRECTORY_SEPARATOR . 'pid'));
            File::deleteDirectory($directory);
            return response()->json([
                'success' => false,
                'message' => 'FFmpeg no recibió video utilizable de este canal. La señal directa sigue disponible en la app IPTV.',
            ], 502);
        } catch (\Throwable $e) {
            Log::error('Error preparando canal compatible.', ['stream_id' => $streamId, 'error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'No se pudo preparar la salida compatible del canal.',
            ], 500);
        }
    }

    /** Sirve únicamente los archivos HLS generados por la aplicación. */
    public function compatibleStreamFile(string $token, string $file)
    {
        if (!preg_match('/^[a-f0-9]{64}$/', $token)) {
            return response('No encontrado', 404);
        }
        if ($file !== 'index.m3u8' && !preg_match('/^segment_[0-9]{9}\.ts$/', $file)) {
            return response('No encontrado', 404);
        }

        $directory = storage_path('app/compat-streams/' . $token);
        $path = $directory . DIRECTORY_SEPARATOR . $file;
        if (!is_file($path)) {
            return response('Segmento no disponible', 404, ['Cache-Control' => 'no-store']);
        }

        @touch($directory . DIRECTORY_SEPARATOR . 'last_access');
        $contentType = $file === 'index.m3u8' ? 'application/vnd.apple.mpegurl' : 'video/mp2t';
        return response()->file($path, [
            'Content-Type' => $contentType,
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /** Detiene la conversión cuando el usuario cambia o cierra el canal. */
    public function stopCompatibleStream(Request $request)
    {
        $validated = $request->validate(['token' => ['required', 'regex:/^[a-f0-9]{64}$/']]);
        $directory = storage_path('app/compat-streams/' . $validated['token']);
        $pidFile = $directory . DIRECTORY_SEPARATOR . 'pid';
        if (is_file($pidFile)) {
            $this->terminateCompatibleProcess((int) file_get_contents($pidFile));
        }
        File::deleteDirectory($directory);
        return response()->json(['success' => true]);
    }

    private function cleanupIdleCompatibleStreams(): void
    {
        $root = storage_path('app/compat-streams');
        if (!is_dir($root)) return;

        foreach (glob($root . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR) ?: [] as $directory) {
            $lastAccess = $directory . DIRECTORY_SEPARATOR . 'last_access';
            $last = is_file($lastAccess) ? (int) @filemtime($lastAccess) : (int) @filemtime($directory);
            if ($last && time() - $last < 180) continue;

            $pidFile = $directory . DIRECTORY_SEPARATOR . 'pid';
            if (is_file($pidFile)) {
                $this->terminateCompatibleProcess((int) @file_get_contents($pidFile));
            }
            File::deleteDirectory($directory);
        }
    }

    private function terminateCompatibleProcess(int $pid): void
    {
        if ($pid < 1) return;
        try {
            if (DIRECTORY_SEPARATOR === '\\') {
                (new SymfonyProcess(['taskkill', '/PID', (string) $pid, '/T', '/F']))->run();
            } elseif (function_exists('posix_kill')) {
                @posix_kill($pid, SIGTERM);
            }
        } catch (\Throwable $e) {
            Log::warning('No se pudo detener un proceso FFmpeg inactivo.', ['pid' => $pid]);
        }
    }

    /**
     * Proxy para la playlist HLS y sus segmentos.
     */
    public function proxy(Request $request)
    {
        $url = $request->query('url');

        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            return response('URL inválida', 400);
        }

        $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));

        if (!in_array($scheme, ['http', 'https'], true)) {
            return response('Protocolo no permitido', 400);
        }

        // Permite únicamente el mismo host configurado para XUI.
        $expectedHost = parse_url($this->xuiServer, PHP_URL_HOST);
        $targetHost = parse_url($url, PHP_URL_HOST);

        if (
            !$expectedHost
            || !$targetHost
            || strcasecmp($expectedHost, $targetHost) !== 0
        ) {
            return response('Servidor no permitido', 403);
        }

        try {
            $finalUrl = $url;
            $expectedHost = parse_url($this->xuiServer, PHP_URL_HOST);
            $response = Http::withOptions([
                'stream' => false,
                'verify' => false,
                'allow_redirects' => [
                    'max' => 5,
                    'protocols' => ['http', 'https'],
                    'on_redirect' => function ($request, $redirectResponse, $uri) use (&$finalUrl, $expectedHost) {
                        if (!$expectedHost || strcasecmp($expectedHost, $uri->getHost()) !== 0) {
                            throw new \RuntimeException('Redirección a un servidor no permitido.');
                        }

                        $finalUrl = (string) $uri;
                    },
                ],
            ])->timeout(30)->get($url);

            if (!$response->successful()) {
                return response('Error upstream', 502);
            }

            $body = $response->body();
            $contentType = $response->header(
                'Content-Type',
                'application/octet-stream'
            );

            // Una playlist HLS contiene #EXTM3U. Reescribimos sus recursos
            // para que también se soliciten a través de /proxy.
            if (str_contains($body, '#EXTM3U')) {
                $baseUri = new \GuzzleHttp\Psr7\Uri($finalUrl);

                $toProxyUrl = function (string $reference) use ($baseUri): string {
                    $absoluteUrl = (string) \GuzzleHttp\Psr7\UriResolver::resolve(
                        $baseUri,
                        new \GuzzleHttp\Psr7\Uri(trim($reference))
                    );

                    return url('/proxy') . '?url=' . rawurlencode($absoluteUrl);
                };

                $rewrittenBody = preg_replace_callback(
                    '/URI="([^"]+)"/i',
                    fn ($match) => 'URI="' . $toProxyUrl($match[1]) . '"',
                    $body
                );

                if ($rewrittenBody !== null) {
                    $body = $rewrittenBody;
                }

                $lines = preg_split('/\r\n|\n|\r/', $body);

                foreach ($lines as &$line) {
                    $trimmed = trim($line);

                    if ($trimmed !== '' && $trimmed[0] !== '#') {
                        $line = str_replace(
                            $trimmed,
                            $toProxyUrl($trimmed),
                            $line
                        );
                    }
                }

                unset($line);

                $body = implode("\n", $lines);
                $contentType = 'application/vnd.apple.mpegurl';
            }

            return response($body, 200, [
                'Content-Type' => $contentType,
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, OPTIONS',
                'Cache-Control' => 'no-cache',
            ]);
        } catch (\Throwable $e) {
            Log::error('Proxy error: ' . $e->getMessage());

            return response('Error proxy', 500);
        }
    }
}
