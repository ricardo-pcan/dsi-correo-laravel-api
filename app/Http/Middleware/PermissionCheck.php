<?php

namespace dsiCorreo\Http\Middleware;

use Closure;
use League\OAuth2\Server\Exception\AccessDeniedException;
use LucaDegasperi\OAuth2Server\Authorizer;
use dsiCorreo\User;

class PermissionCheck
{
    protected $authorizer;
    protected $httpHeadersOnly = false;

    public function __construct(Authorizer $authorizer, $httpHeadersOnly = false)
    {
        $this->authorizer = $authorizer;
        $this->httpHeadersOnly = $httpHeadersOnly;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions )
    {
        $this->authorizer->setRequest( $request );
        $this->authorizer->validateAccessToken( $this->httpHeadersOnly );
        $owner = User::find( $this->authorizer->getResourceOwnerId() );
        if (!$owner->can(explode('|', $permissions))) {
            abort(403);
        }

        return $next($request);
    }
}
