<?php

namespace App\Jobs;

use App\Models\DeveloperProfile;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateDeveloperProfileJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected int $userId;

    protected array $data;

    public function __construct(int $userId, array $data)
    {
        $this->userId = $userId;
        $this->data = $data;
    }

    public function handle(): void
    {
        $developerProfile = DeveloperProfile::where('user_id', $this->userId)->first();

        if (! $developerProfile) {
            // Optionally, handle the case where the profile doesn't exist.
            return;
        }

        $data = $this->data;

        $name = $data['name'] ?? null;
        unset($data['name']);

        $developerProfile->update($data);

        if ($name) {
            $user = User::find($this->userId);
            if ($user) {
                $user->update([
                    'name' => $name,
                ]);
            }
        }
    }
}
