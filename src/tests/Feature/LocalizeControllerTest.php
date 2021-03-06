<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\User;
use App\Services\Locale\Locale;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\UserActingAs;

/**
 * Class LocalizeControllerTest
 * @package Tests\Feature
 * @group LocalizeController
 */
class LocalizeControllerTest extends TestHelper
{
    use RefreshDatabase;
    use UserActingAs;

    /**
     * @var Business
     */
    private $business;
    /**
     * @var User
     */
    private $user;

    /**
     * Отсутствие ключа локализации
     */
    public function testMissingLocaleKey()
    {
        $this->getBusiness($this->user);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSessionMissing(Locale::LOCALE_SESSION_KEY);
    }

    /**
     * Установка ключа локализации
     * @dataProvider getLocale
     * @param string $locale
     */
    public function testLocaleSetRU(string $locale)
    {
        $this->getBusiness($this->user);

        $response = $this->get(route('localize.set', ['locale' => $locale]));

        $response->assertStatus(302);
        $response->assertSessionHas(Locale::LOCALE_SESSION_KEY, $locale);
    }

    /**
     * Ошибочный ключ локализации
     */
    public function testLocaleSetWrong()
    {
        $this->getBusiness($this->user);
        $locale = Str::random(3);

        $response = $this->get(route('localize.set', ['locale' => $locale]));

        $response->assertStatus(302);
        $response->assertSessionMissing(Locale::LOCALE_SESSION_KEY);
    }

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->userActingAs();
    }

    /**
     * Вернет доступные локали
     * @return array
     */
    public function getLocale()
    {
        $locales = Locale::getSupportedLocales();
        return [$locales];
    }
}
