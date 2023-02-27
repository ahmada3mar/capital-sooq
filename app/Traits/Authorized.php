<?php

namespace App\Traits;

trait Authorized
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    public function __construct()
    {
        $model_name = $this->getModelName();
        $this->authorizeResource($model_name, $model_name);
    }

    public function getModelName()
    {
        return "App\\Models\\" . str_replace("Controller", "", class_basename($this));
    }


}
