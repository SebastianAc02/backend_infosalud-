<?php



namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class AlertResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'message' => $this->message,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
