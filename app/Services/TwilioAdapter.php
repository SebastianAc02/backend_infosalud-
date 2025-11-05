<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioAdapter
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.auth_token')
        );
    }

    /**
     * Send SMS message
     *
     * @param string $to Phone number in E.164 format (e.g., +573001234567)
     * @param string $message Message content
     * @return bool Success status
     */
    public function sendSMS(string $to, string $message): bool
    {
        try {
            $this->client->messages->create($to, [
                'from' => config('services.twilio.phone_number'),
                'body' => $message
            ]);

            Log::info("SMS sent successfully", ['to' => $to]);
            return true;

        } catch (\Exception $e) {
            Log::error("SMS failed", [
                'to' => $to,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Send WhatsApp message
     *
     * @param string $to Phone number in E.164 format
     * @param string $message Message content
     * @return bool Success status
     */
    public function sendWhatsApp(string $to, string $message): bool
    {
        try {
            $this->client->messages->create("whatsapp:{$to}", [
                'from' => config('services.twilio.whatsapp_number'),
                'body' => $message
            ]);

            Log::info("WhatsApp sent successfully", ['to' => $to]);
            return true;

        } catch (\Exception $e) {
            Log::error("WhatsApp failed", [
                'to' => $to,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }



}
