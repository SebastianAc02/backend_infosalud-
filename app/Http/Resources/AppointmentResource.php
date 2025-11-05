<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'scheduled_at' => $this->scheduled_at,
            'status' => $this->status,
            'reminders_sent' => [
                '24h' => $this->reminder_24h_sent,
                '1h' => $this->reminder_1h_sent
            ],
        ];
    }
}
