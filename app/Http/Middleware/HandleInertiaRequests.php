<?php

namespace App\Http\Middleware;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'layouts.inertia';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $user = $request->user();
        $search = $request->query('s');

        return array_merge(parent::share($request), [
            'auth.user' => fn() => $user?->only('id', 'email'),
            'search' => [
                'query' => $search,
                'notes' => Auth::user()
                    ->notes()
                    ->latest()
                    ->whereNull('for_date')
                    ->when($search, function (Builder $query) use ($search) {
                        return $query->where('title', 'like', '%'.$search.'%');
                    })
                    ->get()
            ]
        ]);
    }
}