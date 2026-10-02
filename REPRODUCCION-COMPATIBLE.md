# Reproducción compatible FIBRATEC IPTV

La aplicación intenta reproducir primero el canal original. Si el navegador del TV o de la laptop informa un error de decodificación, Laravel inicia FFmpeg en este mismo equipo y entrega una salida HLS con video H.264 Baseline y audio AAC. Esto se aplica al canal que falló, sin listas fijas de IDs.

## Preparar el equipo Windows que ejecuta Laravel

Desde `D:\Proyecto_Compra_Venta\FIBRATEC-IPTV`, ejecutar una vez:

```powershell
npm install
npm run ffmpeg:install
```

Luego iniciar Laravel para que otros dispositivos de la red puedan abrirlo:

```powershell
php artisan serve --host=0.0.0.0 --port=8000
```

La PC debe permanecer encendida mientras se vea el canal. La conversión consume CPU y solo se inicia para canales que fallen en el navegador. Al detener o cambiar el canal, la aplicación cierra el proceso FFmpeg. Si el navegador se desconecta sin cerrar el reproductor, la aplicación limpia el proceso inactivo al iniciar otra conversión.

No se modifica Astra, XUI ni Ubuntu: FFmpeg corre en el equipo Windows de la aplicación.