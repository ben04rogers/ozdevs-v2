<?php

namespace App\Jobs;

use App\Models\CompanyProfile;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCompanyProfileJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(private array $data) {}

    public function handle(): void
    {
        $data = $this->data;

        $name = $data['staff_name'] ?? null;

        unset($data['staff_name']);

        $companyProfile = new CompanyProfile($data);

        $companyProfile->user_id = auth()->id();

        $companyProfile->save();

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
