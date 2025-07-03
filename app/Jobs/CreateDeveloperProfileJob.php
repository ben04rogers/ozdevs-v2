<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DeveloperProfile;
use App\Models\User;

class CreateDeveloperProfileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct(private array $data)
    {
    }

    public function handle(): void
    {
        $data = $this->data;

        $name = $data['name'] ?? null;
        unset($data['name']);

        $developerProfile = new DeveloperProfile($data);
        $developerProfile->user_id = auth()->id();
        $developerProfile->save();

        if ($name) {
            $user = User::find(auth()->id());
            if ($user) {
                $user->update([
                    'name' => $name,
                ]);
            }
        }
    }
}