<?php

namespace App\Jobs;

use App\Models\Guest;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTerminatedGuest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $guest_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($guest_id)
    {
        $this->guest_id = $guest_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $guest = Guest::find($this->guest_id);
        // if guest is status is still Guest::IN_KIOSK then change to Guest::TERMINATED
        if ($guest->status == Guest::IN_KIOSK) {
            $guest->update([
                'status' => Guest::TERMINATED,
                'terminated_at' => Carbon::now(),
            ]);
            // room status update to available and is_priority to true
            $room = Room::find($guest->room_id);

            $room->update([
                'status' => ROOM::AVAILABLE,
                'is_priority' => true,
            ]);
        }
    }
}
