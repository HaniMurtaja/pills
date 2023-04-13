<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCareHealthRequest;
use App\Http\Requests\StoreUserHealthRequest;
use App\Http\Requests\UpdateCareHealthRequest;
use App\Http\Requests\UpdateUserHealthRequest;
use App\Http\Resources\Admin\UserHealthResource;
use App\Models\UserHealth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CareUserHealthApiController extends Controller
{
    public function index()
    {
     //   abort_if(Gate::denies('user_health_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserHealthResource(UserHealth::with(['user'])->get());
    }

    public function store(StoreCareHealthRequest $request)
    {
        $userHealth = UserHealth::create($request->all());

        return (new UserHealthResource($userHealth))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateCareHealthRequest $request,$id)
    {
        $request->validate([
            'careby_id' => 'unique:user_healths,careby_id,'.$id
        ]);
            $userHealth = UserHealth::find($id);
            if ($userHealth)
                $userHealth->update($request->all());

        return (new UserHealthResource($userHealth))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

}
