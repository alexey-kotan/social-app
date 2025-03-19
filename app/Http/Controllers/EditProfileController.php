<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfile\EditNameRequest;
use App\Http\Requests\EditProfile\EditAvatarRequest;
use App\Http\Requests\EditProfile\EditBioRequest;
use App\Services\EditProfileService;

class EditProfileController extends Controller
{
    private EditProfileService $editProfileService;

    public function __construct(EditProfileService $editProfileService)
    {
        $this->editProfileService = $editProfileService;
    }
    
    public function avatar(EditAvatarRequest $request) {

        $this->editProfileService->avatar($request);

        return redirect('edit_profile')->with('success_edit', 'Ваш аватар успешно обновлен.');
    }

    public function bio(EditBioRequest $request) {

        $this->editProfileService->bio($request);   

        return redirect('edit_profile')->with('success_edit', 'БИО отредактированно.');
    }

    public function name(EditNameRequest $request) {

        $this->editProfileService->name($request);   

        return redirect('edit_profile')->with('success_edit', 'Ваше имя изменено.');
    }
}
