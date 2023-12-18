<?php

namespace App\Services;

use App\Events\UserApiActivityEvent;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    /**
     * UserRepository construct injection
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepository = $userRepositoryInterface;
    }

    /**
     * @param RegisterRequest $request
     *
     * @return object
     * @throws ValidationException
     */
    public function register(RegisterRequest $request): object
    {
        if ($request->validator->fails()) {
            return ResponseResult::generate(false, $request->validator->messages(), ResponseCodes::HTTP_BAD_REQUEST);
        }

        try {
            $user = new User();
            $user->setAttribute('name', $request->get('name'));
            $user->setAttribute('email', $request->get('email'));
            $user->setAttribute('password', Hash::make($request->get('password')));
            $this->userRepository->register($user);

            return ResponseResult::generate(true, 'User registration successful.', ResponseCodes::HTTP_CREATED);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                ResponseResult::generate(false, $exception->getMessage(), ResponseCodes::HTTP_BAD_REQUEST),
            ]);
        }
    }

    /**
     * @param LoginRequest $request
     *
     * @return object
     * @throws ValidationException
     */
    public function login(LoginRequest $request): object
    {
        if ($request->validator->fails()) {
            return ResponseResult::generate(false, $request->validator->messages(), ResponseCodes::HTTP_BAD_REQUEST);
        }

        try {
            if (Auth::attempt($request->except('error_list'))) {
                $token = $this->userRepository->generateToken(Auth::user());

                UserApiActivityEvent::dispatch($request);

                return ResponseResult::generate(true, ['token' => $token], ResponseCodes::HTTP_OK);
            }

            return ResponseResult::generate(false, ['user' => "User not found."], ResponseCodes::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                ResponseResult::generate(false, $exception->getMessage(), ResponseCodes::HTTP_BAD_REQUEST),
            ]);
        }
    }
}
