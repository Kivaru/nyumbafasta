<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'api/v1/user/login',
        'api/v1/user/register',
        'api/v1/mobilepush/payment',
        'api/v1/card/payment',
        'api/v1/add-to-favorite',
        'api/v1/profile/update',
        'api/v1/mobilepush/kiwanja-buku',
        'api/v1/card/payment/kiwanja-buku',
        'api/v1/landlord/house/upload',
        'api/v1/mobilepush/donation',
        'api/v1/card/payment/donation',
    ];
}
