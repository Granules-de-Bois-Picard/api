<?php

namespace App\Repositories;

use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserUploadProfilePictureRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Services\LocalFileService;
use App\Transformers\UserTransformer;
use Exception;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository implements UserRepositoryInterface
{
    private LocalFileService $localFileService;

    public function __construct(LocalFileService $localFileService)
    {
        $this->localFileService = $localFileService;
    }

    public function index(): ?array
    {
        $users = QueryBuilder::for(User::class)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        return fractal($users, new UserTransformer())->toArray();
    }

    public function store(UserStoreRequest $request)
    {
        //
    }

    public function show($id): ?array
    {
        $user = User::findOrFail($id);

        return fractal($user, new UserTransformer())->toArray();
    }

    /**
     * @throws Exception
     */
    public function update(UserUpdateRequest $request, $id): ?array
    {
        $user = User::findOrFail($id);

        $user->update($request->validated());

        return fractal($user, new UserTransformer())->toArray();
    }

    /**
     * @throws Exception
     */
    public function uploadProfilePicture(UserUploadProfilePictureRequest $request, $id): ?array
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                $this->localFileService->deleteFile($user->profile_picture, 'profile_pictures');
            }

            $file = $request->file('profile_picture');
            $newFileName = $user->id . '_' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $url = $this->localFileService->uploadFile($request->file('profile_picture'), 'profile_pictures', $newFileName);

            $user->update([
                'profile_picture' => $url,
            ]);

            return fractal($user, new UserTransformer())->toArray();
        }

        throw new Exception('No profile picture uploaded.');
    }

    /**
     * @throws Exception
     */
    public function changePassword(UserChangePasswordRequest $request, $id): ?array
    {
        $user = User::findOrFail($id);

        if (!password_verify($request->validated()['current_password'], $user->password)) {
            throw new Exception('Current password is incorrect.');
        }

        $user->update([
            'password' => bcrypt($request->validated()['password']),
        ]);

        return fractal($user, new UserTransformer())->toArray();
    }

    public function destroy($id)
    {
        //
    }
}
