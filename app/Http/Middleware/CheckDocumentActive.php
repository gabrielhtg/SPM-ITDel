<?php

namespace App\Http\Middleware;

use App\Models\DocumentModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CheckDocumentActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allDocuments = DocumentModel::all();

        foreach ($allDocuments as $e) {
            $carbonObject = Carbon::createFromFormat('Y-m-d H:i:s', $e->end_date);
            $nowDate = Carbon::createFromFormat('Y-m-d H:i:s', now());

            if ($carbonObject->lessThan($nowDate)) {
                $e->update([
                    'keterangan_status' => false
                ]);
            }
        }

        return $next($request);
    }
}
