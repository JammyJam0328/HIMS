<?php

namespace App\Traits;

trait WithAlert
{
    public function notify($type = 'success', $title = 'Notification', $message = null)
    {
        $this->dispatchBrowserEvent('notify', [
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ]);
    }

    public function alert($type = 'success', $title = 'Notification', $message = null)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ]);
    }
}
