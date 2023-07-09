<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyOTPRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Services\Auth\AuthServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Mockery;
use Carbon\Carbon;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * @covers \App\Http\Controllers\Auth\AuthController::verifyOTP
     */
    public function testLogin(): void
    {
        $authController = new AuthController();
        $loginRequest = Mockery::mock(LoginRequest::class);
        $loginRequest->shouldReceive('validated')->once()->andReturn([]);
        $authService = Mockery::mock(AuthServices::class);
        $authService->shouldReceive('loginToJWT')->once()->with([])->andReturn(['token' => 'token', 'user' => [
            'id' => 1,
            'name' => 'fliiw',
            'email' => 'fliw@fliw.com',
            'phone' => '08812671057',
            'phone_verified_at' => '09-05-2001 00:00:00',
            'created_at' => Carbon::parse('09-05-2001 00:00:00'),
            'created_since' => '22 years ago',
        ]]);
        $response = $authController->login($loginRequest, $authService);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals('token', $response->getData()->token);
        $this->assertInstanceOf(LoginResource::class, $response->getOriginalContent());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @covers \App\Http\Controllers\Auth\AuthController::ResendOTP
     */
    public function testResendOTP(): void
    {
        $authController = new AuthController();
        $authService = Mockery::mock(AuthServices::class);

        $user = new User();
        $this->actingAs($user);

        $authService->shouldReceive('resendOTP')->once()->with($user)->andReturn(response()->json(['message' => 'OTP sent successfully']));
        $response = $authController->resendOTP($authService);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['message' => 'OTP sent successfully'], $response->getData(true));
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @covers \App\Http\Controllers\Auth\AuthController::verifyOTP
     */

    public function testVerifyOTP(): void
    {
        $authController = new AuthController();
        $authService = Mockery::mock(AuthServices::class);
        $request = new VerifyOTPRequest(['otp' => '123456']);

        $user = new User();
        $this->actingAs($user);


        $authService->shouldReceive('verifyOTP')->once()->with($user, '123456')->andReturn(response()->json(['message' => 'OTP verified successfully']));
        $response = $authController->verifyOTP($request, $authService);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['message' => 'OTP verified successfully'], $response->getData(true));
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @covers \App\Http\Controllers\Auth\AuthController::register
     */

    public function testRegister(): void
    {
        $authController = new AuthController();
        $registerRequest = Mockery::mock(RegisterRequest::class);
        $registerRequest->shouldReceive('validated')->once()->andReturn([
            'name' => 'Fliw',
            'email' => 'fliw@fliw.com',
            'password' => 'fliw12345',
            'phone' => '08812671057'
        ]);

        $authService = Mockery::mock(AuthServices::class);
        $authService->shouldReceive('registerUser')->once()->with([
            'name' => 'Fliw',
            'email' => 'fliw@fliw.com',
            'password' => 'fliw12345',
            'phone' => '08812671057',
        ])->andReturn([
            'token' => 'token',
            'user' => [
                'id' => 1,
                'name' => 'Fliw',
                'email' => 'fliw@fliw.com',
                'phone' => '08812671057',
                'phone_verified_at' => null,
                'created_at' => Carbon::parse('09-05-2001 00:00:00'),
                'created_since' => '22 years ago',
            ]
        ]);

        $response = $authController->register($registerRequest, $authService);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals([
            'token' => 'token',
            'user' => [
                'id' => 1,
                'name' => 'Fliw',
                'email' => 'fliw@fliw.com',
                'phone' => '08812671057',
                'phone_verified_at' => null,
                'created_at' => Carbon::parse('09-05-2001 00:00:00')->format('d-m-Y H:i:s'),
                'created_since' => '22 years ago',
            ],
            'message' => 'Register success, but you need to verify your whatsapp number, An OTP code has been sent to your whatsapp number'
        ], $response->getData(true));
        $this->assertInstanceOf(RegisterResource::class, $response->getOriginalContent());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
