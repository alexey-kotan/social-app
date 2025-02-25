<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfile\EditNameRequest;
use App\Http\Requests\EditProfile\EditAvatarRequest;
use App\Http\Requests\EditProfile\EditBioRequest;
use App\Services\EditProfile\AvatarService;
use App\Services\EditProfile\BioService;
use App\Services\EditProfile\NameService;

class EditProfileController extends Controller
{
    private AvatarService $avatarService;
    private BioService $bioService;
    private NameService $nameService;

    public function __construct(AvatarService $avatarService,BioService $bioService,NameService $nameService)
    {
        $this->avatarService = $avatarService;
        $this->bioService = $bioService;
        $this->nameService = $nameService;
    }
    
    public function avatar(EditAvatarRequest $request) {

        $this->avatarService->avatar($request);

        return redirect('edit_profile')->with('success_edit', 'Ваш аватар успешно обновлен.');
    }

    public function bio(EditBioRequest $request) {

        $this->bioService->bio($request);   

        return redirect('edit_profile')->with('success_edit', 'БИО отредактированно.');
    }

    public function name(EditNameRequest $request) {

        $this->nameService->name($request);   

        return redirect('edit_profile')->with('success_edit', 'Ваше имя изменено.');
    }
}
