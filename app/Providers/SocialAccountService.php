<?php

namespace App\Providers;

use Laravel\Socialite\Contracts\Provider;
use App\User;
use App\Models\SocialAccount;

class SocialAccountService
{
     /**
     * Create or get user isset.
     *
     * @param Laravel\Socialite\Contracts\Provider $provider provider
     *
     * @return App\User
     */
    public function createOrGetUser(Provider $provider)
    {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);
        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);
            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
            }
            $account->user()->associate($user);
            $account->save();
            return $user;
        }
    }
}
