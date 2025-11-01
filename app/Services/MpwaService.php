<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MpwaService
{
    public static function normalizeNumber($number)
    {
        if (!$number) return null;

        // Hanya angka
        $number = preg_replace('/[^0-9]/', '', $number);

        // 08xxxx → 628xxxx
        if (substr($number, 0, 2) === "08") {
            $number = "62" . substr($number, 1);
        }

        // 8xxxx → 628xxxx
        if (substr($number, 0, 1) === "8") {
            $number = "62" . $number;
        }

        // Jika sudah 62xxxxx, biarkan
        return $number;
    }

    public static function sendMessage($number, $message)
    {
        $endpoint = "http://mpwa.cibunarhiap.id/send-message";

        // Normalisasi otomatis
        $number = self::normalizeNumber($number);
        if (!$number) return false;

        $payload = [
            "api_key" => env('MPWA_API_KEY'),
            "sender"  => env('MPWA_SENDER'),
            "number"  => $number,
            "message" => $message,
        ];

        return Http::post($endpoint, $payload);
    }
}
