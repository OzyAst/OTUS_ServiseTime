<?php

namespace Tests\Traits;

use App\Models\User;
use App\Models\UserRole;

/**
 * Создание роли и пользователя
 * и использование его в качестве пользователя для теста
 *
 * Trait UserActingAs
 * @package Tests\Traits
 */
trait UserActingAs
{
    public function userActingAs(User $user = null, string $driver = "") {
        if (!$user) {
            $role = factory(UserRole::class)->create();
            $this->user = factory(User::class)->create([
                'user_role_id' => $role->id,
            ]);
        } else {
            $this->user = $user;
        }

        $this->actingAs($this->user, $driver);
    }
}
