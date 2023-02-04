<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserHealthRequest;
use App\Http\Requests\UpdateUserHealthRequest;
use App\Http\Resources\Admin\UserHealthResource;
use App\Models\UserHealth;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserHealthApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_health_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserHealthResource(UserHealth::with(['user'])->get());
    }

    public function store(StoreUserHealthRequest $request)
    {
        $userHealth = UserHealth::create($request->all());

        return (new UserHealthResource($userHealth))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserHealth $userHealth)
    {
        abort_if(Gate::denies('user_health_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserHealthResource($userHealth->load(['user']));
    }

    public function update(UpdateUserHealthRequest $request, UserHealth $userHealth)
    {
        $userHealth->update($request->all());

        return (new UserHealthResource($userHealth))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserHealth $userHealth)
    {
        abort_if(Gate::denies('user_health_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userHealth->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
