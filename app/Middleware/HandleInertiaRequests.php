<?php

namespace App\Middleware;

use App\Core\Cart\CartService;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware {
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'blade.app';



    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request) : ?string {
        return parent::version($request);
    }



    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request) : array {
        $panier_info = static fn() => CartService::get_cart_info();


        return array_merge(parent::share($request), [
            "panier_info" => $panier_info,
        ]);
    }
}