<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Services\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendAppointmentReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Number of times to retry if job fails
     */
    public int $tries = 3;

    /**
     * Seconds to wait between retries
     */
    public array $backoff = [60, 300, 900]; // 1min, 5min, 15min

    /**
     * Create a new job instance
     */
    public function __construct(
        public int $appointmentId,
        public string $reminderType
    ) {}

    /**
     * Execute the job
     */
    public function handle(NotificationService $notificationService): void
    {
        $appointment = Appointment::with('user')->find($this->appointmentId);

        if (!$appointment) {
            Log::warning("Appointment not found", ['id' => $this->appointmentId]);
            return;
        }

        // Skip if already cancelled
        if ($appointment->status === 'cancelled') {
            return;
        }

        // Skip if user disabled notifications
        if (!$appointment->user->notifications_enabled) {
            return;
        }

        // Send the notification
        $success = $notificationService->sendAppointmentReminder(
            $appointment,
            $this->reminderType
        );

        if (!$success) {
            throw new \Exception("Failed to send reminder for appointment {$this->appointmentId}");
        }

        // Mark as sent (we'll add this field later)
        $this->markReminderSent($appointment);
    }

    /**
     * Handle job failure
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("Reminder job failed permanently", [
            'appointment_id' => $this->appointmentId,
            'reminder_type' => $this->reminderType,
            'error' => $exception->getMessage()
        ]);
    }

    private function markReminderSent(Appointment $appointment): void
    {
        $field = $this->reminderType === '3_days' ? 'reminder_3days_sent' : 'reminder_1day_sent';
        $appointment->update([$field => true]);
    }
}
