<?php

namespace App\Http\Middleware;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        $search = $request->query('s');

        return array_merge(parent::share($request), [
            'auth.user' => fn() => $user?->only('id', 'email'),
            'last_daily_note_at' => $user?->last_daily_note_at(),
            'search' => [
                'query' => $search,
                'notes' => $user?->notes()
                    ->latest()
                    ->when(! $search, function (Builder $query) use ($search) {
                        return $query->whereNull('for_date');
                    })
                    ->when($search, function (Builder $query) use ($search) {
                        return $query->where(function (Builder $query) use ($search) {
                            return $query->where('title', 'like', '%'.$search.'%')
                                ->orWhere('content', 'like', '%'.$search.'%');
                        });
                    })
                    ->get()
            ]
        ]);
    }
}
