<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PopularUserMail;

class CheckPopularUsers extends Command
{
    protected $signature = 'check:popular-users';
    protected $description = 'Check users with likes above threshold and email admin';

    public function handle()
    {
        $threshold = (int) env('POPULAR_THRESHOLD', 50);
        $adminEmail = env('ADMIN_EMAIL');

        if (! $adminEmail) {
            $this->error('ADMIN_EMAIL not set in .env');
            return 1;
        }

        $users = User::withCount([
            'swipesReceived as likes_count' => function ($q) {
                $q->where('type', 'like');
            }
        ])->having('likes_count', '>', $threshold)
          ->get();

        foreach ($users as $user) {
            Mail::to($adminEmail)->send(new PopularUserMail($user, $user->likes_count));
            $this->info("Notified {$adminEmail} about user {$user->id} (likes={$user->likes_count})");
        }

        return 0;
    }
}
