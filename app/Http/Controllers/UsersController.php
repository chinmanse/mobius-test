<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\Users;
use App\Enums\GenderType;
use App\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use App\Classes\ApiResponseClass;

class UsersController extends Controller
{
  
  private UserRepositoryInterface $userRepositoryInterface;

  public function __construct(UserRepositoryInterface $userRepositoryInterface)
  {
    $this->userRepositoryInterface = $userRepositoryInterface;
  }

    /**
     * @OA\Info(title="Users API", version="0.1")
     * @OA\Get(
     *     path="/api/users",
     *     @OA\Response(response="200", description="Listado de usuarios")
     * )
     */
    public function index()
    {
      try{
        $data = $this->userRepositoryInterface->index();
        return ApiResponseClass::sendResponse(UserResource::collection($data),'',200);
      }catch(\Exception $e){
        return ApiResponseClass::rollback($e);
      }
    }

    /**
     * @OA\Get(
     *     path="/api/users/create",
     *     @OA\Response(response="200", description="Datos necesarios para la creación de usuarios")
     * )
     */
    public function create()
    {
      try{
        $data = $this->userRepositoryInterface->create();
        return ApiResponseClass::sendResponse($data,'',200);
      }catch(\Exception $e){
        return ApiResponseClass::rollback($e);
      }
    }

    /**
     * @OA\Post(
     *     path="/api/users/",
     *     description="Registro de usuario",
     *     @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *           type="object",
     *           required={"first_name","last_name","email","password", "address", "phone", "phone_2", "postal_code", "birth_date", "gender"},
     *           @OA\Property(property="first_name",type="text"),
     *           @OA\Property(property="last_name",type="text"),
     *           @OA\Property(property="email",type="email"),
     *           @OA\Property(property="password",type="text"),
     *           @OA\Property(property="address",type="text"),
     *           @OA\Property(property="phone",type="text"),
     *           @OA\Property(property="phone_2",type="text"),
     *           @OA\Property(property="postal_code",type="text"),
     *           @OA\Property(property="birth_date",type="date"),
     *           @OA\Property(property="gender",type="text"),
     *         )
     *       ),
     *     ),
     *     @OA\Response(response="200", description="Usuario registrado", @OA\JsonContent())
     * )
     */
    public function store(StoreUsersRequest $request)
    {
      DB::beginTransaction();
      try{
        $data = $request->all();
        $user = $this->userRepositoryInterface->store($data);
        DB::commit();
        return ApiResponseClass::sendResponse(new UserResource($user),'User created satisfactory',200);
      }catch(\Exception $e){
        return ApiResponseClass::rollback($e);
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}/",
     *     description="Registro de usuario",
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="UID del usuario a actualizar",
     *       @OA\Schema(type="string"),
     *     ),
     *     @OA\RequestBody(
     *       @OA\JsonContent(),
     *       @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *           type="object",
     *           required={"first_name","last_name","email","password", "address", "phone", "phone_2", "postal_code", "birth_date", "gender"},
     *           @OA\Property(property="first_name",type="string"),
     *           @OA\Property(property="last_name",type="text"),
     *           @OA\Property(property="email",type="email"),
     *           @OA\Property(property="password",type="text"),
     *           @OA\Property(property="address",type="text"),
     *           @OA\Property(property="phone",type="text"),
     *           @OA\Property(property="phone_2",type="text"),
     *           @OA\Property(property="postal_code",type="text"),
     *           @OA\Property(property="birth_date",type="date"),
     *           @OA\Property(property="gender",type="text"),
     *         )
     *       ),
     *     ),
     *     @OA\Response(response="200", description="Usuario registrado", @OA\JsonContent())
     * )
     */
    public function update(UpdateUsersRequest $request, $id)
    {
      DB::beginTransaction();
      try{
        $data = $request->all();
        $user = $this->userRepositoryInterface->update($request, $id);
        DB::commit();
        return ApiResponseClass::sendResponse(new UserResource($user),'User updated satisfactory',200);
      }catch(\Exception $e){
        return ApiResponseClass::rollback($e);
      }
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}/",
     *     description="Eliminación de usuario",
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="UID del usuario a eliminar",
     *       @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(response="200", description="Usuario registrado", @OA\JsonContent())
     * )
     */
    public function destroy($id)
    {
      DB::beginTransaction();
      try{
        $user = $this->userRepositoryInterface->delete($id);
        DB::commit();
        return ApiResponseClass::sendResponse(null,'User deleted satisfactory',200);
      }catch(\Exception $e){
        return ApiResponseClass::rollback($e);
      }
    }
}
