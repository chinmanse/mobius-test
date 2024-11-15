<?php

namespace App\Repositories;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Users;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Enums\GenderType;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $users = Users::all(); 
      return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      $genderType = collect(GenderType::cases())
        ->map(fn($gender) => [
          'id' => $gender->name,
          'name' => $gender->value
        ])
      ;
      return [
        "gender_type" => $genderType
      ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
      $request["uid"] = (string)Str::uuid();
      $user = Users::create($request);
      return $user;
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
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request,$id)
    {
      $user = Users::where("uid", $id)->first();
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->address = $request->address;
      $user->phone = $request->phone;
      $user->phone_2 = $request->phone_2;
      $user->postal_code = $request->postal_code;
      $user->birth_date = $request->birth_date;
      $user->gender = $request->gender;
      $user->save();
      return $user;
    }

    public function delete($id){
      $user = Users::where("uid", $id)->first();
      $user->delete();
    }

    public function getById($id){return "asdasdas";}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $users)
    {
        //
    }
}
