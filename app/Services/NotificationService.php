<?php

namespace App\Services;

use App\Models\Appointment;

class NotificationService
{
    public function __construct(
        private TwilioAdapter $twilioAdapter
    ) {}

    /**
     * Send appointment reminder
     *
     * @param Appointment $appointment
     * @param string $reminderType '3_days' or '1_day'
     * @return bool
     */
    public function sendAppointmentReminder(Appointment $appointment, string $reminderType): bool
    {
        $user = $appointment->user;

        // Build message
        $timeLabel = $reminderType === '3_days' ? '3 días' : '1 día';
        $message = $this->buildReminderMessage($appointment, $timeLabel);

        // Choose channel based on user preference
        if ($user->notification_channel === 'whatsapp') {
            return $this->twilioAdapter->sendWhatsApp($user->phone, $message);
        }

        return $this->twilioAdapter->sendSMS($user->phone, $message);
    }

    /**
     * Send confirmation request
     */
    public function sendConfirmationRequest(Appointment $appointment): bool
    {
        $user = $appointment->user;
        $message = "Por favor confirma tu cita: {$appointment->title} - {$appointment->scheduled_at->format('d/m/Y H:i')}. Responde SI para confirmar o NO para cancelar.";

        if ($user->notification_channel === 'whatsapp') {
            return $this->twilioAdapter->sendWhatsApp($user->phone, $message);
        }

        return $this->twilioAdapter->sendSMS($user->phone, $message);
    }

    /**
     * Build reminder message
     */
    private function buildReminderMessage(Appointment $appointment, string $timeLabel): string
    {
        return "🏥 Recordatorio: Tienes una cita médica en {$timeLabel}\n\n"
            . "📋 {$appointment->title}\n"
            . "📅 {$appointment->scheduled_at->format('d/m/Y')}\n"
            . "🕐 {$appointment->scheduled_at->format('H:i')}\n"
            . ($appointment->location ? "📍 {$appointment->location}\n" : "")
            . "\n¡No olvides asistir!";
    }


    // app/Services/NotificationService.php
    public function sendWhatsApp(string $to, string $message): bool
    {
        return $this->twilioAdapter->sendWhatsApp($to, $message);
    }


    public function sendSMS(string $to, string $message): bool
    {
        return $this->twilioAdapter->sendSMS($to, $message);
    }


}
