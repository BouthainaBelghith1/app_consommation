<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class Fact implements ShouldBroadcastNow
{
    use SerializesModels;

    private $facture;

    public function __construct($facture)
    {
        $this->facture = $facture;
    }

    public function broadcastWith()
    {
        return ['message' => $this->facture];
    }

    public function broadcastOn()
    {
        return 'public'; // Retourne le nom du canal sous forme de chaîne de caractères
    }
}
