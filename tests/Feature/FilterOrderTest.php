<?php

namespace Tests\Feature;

use App\Helper\NumberHelper;
use App\Jobs\SendSmsJob;
use App\Mail\AdminNotificationExceptionMail;
use App\Models\Equipment;
use App\Models\Order;
use App\Models\User;
use App\Services\FilterService;
use Exception;
use Faker\Generator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class FilterOrderTest extends TestCase
{
    use RefreshDatabase;
    private Generator $faker;

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        /** @var Generator $faker */
        $faker = app()->make(Generator::class);
        $this->faker = $faker;

        // Mock the mail and queue for SMS job
        Mail::fake();
        Bus::fake();

        User::factory(10)->create();
        Equipment::factory(10)->create();
        Order::factory(10)->create();
    }

    /**
     * @test
     * @throws Exception
     */
    public function filterOrderShouldThrowExceptionToSendEmailAndSmsToAdmin(): void
    {
        $this->mock(FilterService::class, function ($mock) {
            $mock->shouldReceive('applyFilters')->andThrow(new Exception('Test exception'));
        });

        $responseRequestFilterOrder = $this->post(
            route('api.backoffice.orders'),
            [
                'status' => $this->faker->randomElement(Order::getStatuses()),
                'amount' => ['min' => random_int(1, 10), 'max' => random_int(11, 30)],
                'nationalCode' => NumberHelper::fakeNationalCode()
            ]
        );

        $responseRequestFilterOrder->assertStatus(500);

        Mail::assertQueued(AdminNotificationExceptionMail::class);
        Bus::assertDispatched(SendSmsJob::class);
    }
}
