<?php

namespace Illuminate\Http\Middleware;

use Closure;

class ConvertEmptyStringsToNull
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
        $response = $next($request);

        $this->clean($request->all());

        return $response;
    }

    /**
     * Convert empty strings to null.
     *
     * @param  array  $data
     * @return void
     */
    protected function clean(&$data)
    {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $this->clean($value);
            } elseif ($value === '') {
                $value = null;
            }
        }
    }
}
