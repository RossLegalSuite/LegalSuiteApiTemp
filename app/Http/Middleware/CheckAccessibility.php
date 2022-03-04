<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccessibility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (strtok($request->path(), '/') == 'createview' & $request->user()->grantAccess == 1 & $request->user()->getAccessFlag == 1) {
            return $next($request);
        }

        if ($request->user()->grantAccess != 1) {
            return abort(403);
        }

        //Remove when old GET/PUT/POST/DELETE Methods are depricated.
        // switch ($request->method()) {

        //     case 'GET':
        //         if ($request->user()->getAccessFlag != 1) {

        //             return abort(403);

        //         }
        //         break;

        //     case 'POST':
        //         if ($request->user()->postAccessFlag != 1) {

        //             return abort(403);

        //         }
        //         break;

        //     case 'PUT':
        //         if ($request->user()->putAccessFlag != 1) {

        //             return abort(403);

        //         }
        //         break;

        //     case 'DELETE':
        //         if ($request->user()->deleteAccessFlag != 1) {

        //             return abort(403);

        //         }
        //         break;

        //         default:
        //         return $next($request);
        //         break;
        // }

        preg_match('/\/(\w*)\/?/', $request->path(), $output_array);

        if (isset($output_array[1])) {
            $method = $output_array[1];

            switch ($method) {

                case 'get':
                    if ($request->user()->getAccessFlag != 1) {
                        return abort(403);
                    }
                    break;

                case 'view':
                    if ($request->user()->getAccessFlag != 1) {
                        return abort(403);
                    }
                    break;

                case 'store':
                    if ($request->user()->postAccessFlag != 1) {
                        return abort(403);
                    }
                    break;

                case 'update':
                    if ($request->user()->putAccessFlag != 1) {
                        return abort(403);
                    }
                    break;

                case 'delete':
                    if ($request->user()->deleteAccessFlag != 1) {
                        return abort(403);
                    }
                    break;

                    default:
                    return $next($request);
                    break;
            }
        }

        return $next($request);
    }
}
