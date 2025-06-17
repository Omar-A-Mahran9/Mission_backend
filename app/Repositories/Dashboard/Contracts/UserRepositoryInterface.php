<?php

namespace App\Repositories\Dashboard\Contracts;

interface  UserRepositoryInterface
{
    public function index($data);
    public function show($user);
    public function approve($request,$user, $document);
    public function certificatesAjax($user);
    public function experiencesAjax($user);
    public function licensesAjax($user);
    public function portfoliosAjax($user);
    public function status($user);
    public function isValid($request,$user);
}
