<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Blog\BaseController as GuestBaseController;

/**
 * Base controller for all manage blog controllers
 * in admin panel.
 *
 * Must be parent all mange controller blog.
 *
 * @package App\Http\Controllers\Blog
 */
abstract class BaseController extends GuestBaseController
{

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
    }
}
