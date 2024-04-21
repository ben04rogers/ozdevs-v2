<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Models\CompanyProfile;

class CreateCompanyProfileCommand extends Command
{
    protected $signature = 'app:create-company-profile-command';

    protected $description = 'Create new company profile';

    protected array $data;

    public function __construct(array $data)
    {
        parent::__construct();

        $this->data = $data;
    }

    public function handle()
    {
        $name = $this->data['staff_name'] ?? null;

        unset($this->data['staff_name']);

        $companyProfile = new CompanyProfile($this->data);

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
