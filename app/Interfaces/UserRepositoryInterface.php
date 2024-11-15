<?php

namespace App\Interfaces;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
interface UserRepositoryInterface
{
  public function index();
  public function getById($id);
  public function create();
  public function store(StoreUsersRequest $data);
  public function update(UpdateUsersRequest $data,$id);
  public function delete($id);
}
