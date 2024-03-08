<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Auth0\Laravel\{UserRepositoryAbstract, UserRepositoryContract};
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserRepository extends UserRepositoryAbstract implements UserRepositoryContract
{
    public function fromAccessToken(array $user): ?Authenticatable
    {
        // return new StatelessUser($user);

        /*
        $user = [ // Example of a decoded access token
            "iss"   => "https://example.auth0.com/",
            "aud"   => "https://api.example.com/calendar/v1/",
            "sub"   => "auth0|123456",
            "exp"   => 1458872196,
            "iat"   => 1458785796,
            "scope" => "read write",
        ];
        */
        $identifier = $user['sub'] ?? $user['auth0'] ?? null;
        if (is_null($identifier)) {
            return null;
        }
        return User::where('auth0', $identifier)->first();
    }

    public function fromSession(array $user): ?Authenticatable
    {
        // return new StatefulUser($user);

        /*
        $user = [ // Example of a decoded ID token
            "iss"         => "http://example.auth0.com",
            "aud"         => "client_id",
            "sub"         => "auth0|123456",
            "exp"         => 1458872196,
            "iat"         => 1458785796,
            "name"        => "Jane Doe",
            "email"       => "janedoe@example.com",
        ];
        */
        $identifier = $user['sub'] ?? $user['auth0'] ?? null;
        $verified = in_array($user['email_verified'], [1, true], true);

        $profile = [
            'auth0' => $identifier,
            'name' => $user['name'] ?? '',
            'email' => $user['email'] ?? '',
            'email_verified' => $verified,
        ];

        $cacheKey = "auth0_user_{$identifier}";
        $cached = $this->withoutRecording(fn () => Cache::get($cacheKey));
        if ($cached) {
            return $cached;
        }

        $user = null;
        if (!is_null($identifier)) {
            $user = User::where('auth0', $identifier)->first();
        }

        if (is_null($user) && isset($user['email'])) {
            $user = User::where('email', $user['email'])->first();
        }

        if (!is_null($user)) {
            $updates = [];

            $keys = [
                'auth0',
                'name',
                'email',
            ];
            foreach ($keys as $key) {
                if ($user[$key] !== $profile[$key]) {
                    $user[$key] = $profile[$key];
                }
            }

            $verified = in_array($user->email_verified, [1, true], true);
            if ($verified !== $profile['email_verified']) {
                $updates['email_verified'] = $profile['email_verified'];
            }

            if (count($updates) > 0) {
                $user->update($updates);
                $user->save();
            } else if (!is_null($cached)) {
                return $user;
            }
        }
        if (is_null($user)) {
            // ダミー値をパスワードに登録する
            $profile['password'] = Hash::make(Str::random(32));
            $user = User::create($profile);
        }
        // キャッシュ30秒間
        $this->withoutRecording(fn () => Cache::put($cacheKey, $user, 30));

        return $user;
    }

    /**
     * Workaround for Laravel Telescope potentially causing an infinite loop.
     * @link https://github.com/auth0/laravel-auth0/tree/main/docs/Telescope.md
     *
     * @param callable $callback
     */
    private function withoutRecording($callback): mixed
    {
        $telescope = '\Laravel\Telescope\Telescope';

        if (class_exists($telescope)) {
            return "$telescope"::withoutRecording($callback);
        }

        return call_user_func($callback);
    }
}
