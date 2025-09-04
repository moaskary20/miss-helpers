<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Log activity for authenticated users (if activities table exists)
        if (Auth::check() && ($request->isMethod('POST') || $request->isMethod('PUT') || $request->isMethod('DELETE'))) {
            try {
                $user = Auth::user();
                
                $action = $this->determineAction($request);
                $module = $this->determineModule($request);
                $description = $this->generateDescription($request, $action);
                
                $user->activities()->create([
                    'action' => $action,
                    'module' => $module,
                    'description' => $description,
                    'details' => $this->getRequestDetails($request),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);
            } catch (\Exception $e) {
                // Activities table doesn't exist, skip logging
            }
        }

        return $response;
    }

    /**
     * Determine the action based on request method
     */
    private function determineAction(Request $request): string
    {
        if ($request->isMethod('POST')) {
            return 'create';
        } elseif ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            return 'update';
        } elseif ($request->isMethod('DELETE')) {
            return 'delete';
        }
        
        return 'view';
    }

    /**
     * Determine the module based on route
     */
    private function determineModule(Request $request): string
    {
        $path = $request->path();
        
        if (str_contains($path, 'maids')) return 'maids';
        if (str_contains($path, 'blog')) return 'blog';
        if (str_contains($path, 'categories')) return 'categories';
        if (str_contains($path, 'customer-reviews')) return 'customer_reviews';
        if (str_contains($path, 'service-requests')) return 'service_requests';
        if (str_contains($path, 'chat')) return 'chat';
        if (str_contains($path, 'users')) return 'users';
        
        return 'system';
    }

    /**
     * Generate description for the activity
     */
    private function generateDescription(Request $request, string $action): string
    {
        $module = $this->determineModule($request);
        $moduleName = $this->getModuleDisplayName($module);
        
        switch ($action) {
            case 'create':
                return "إنشاء {$moduleName} جديد";
            case 'update':
                return "تحديث {$moduleName}";
            case 'delete':
                return "حذف {$moduleName}";
            default:
                return "عرض {$moduleName}";
        }
    }

    /**
     * Get module display name
     */
    private function getModuleDisplayName(string $module): string
    {
        $modules = [
            'maids' => 'خادمة',
            'blog' => 'موضوع',
            'categories' => 'قسم',
            'customer_reviews' => 'رأي عميل',
            'service_requests' => 'طلب خدمة',
            'chat' => 'محادثة',
            'users' => 'مستخدم',
            'system' => 'نظام'
        ];
        
        return $modules[$module] ?? $module;
    }

    /**
     * Get request details for logging
     */
    private function getRequestDetails(Request $request): array
    {
        $details = [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'route' => $request->route() ? $request->route()->getName() : null,
        ];

        // Add form data (excluding sensitive fields)
        $formData = $request->except(['password', 'password_confirmation', '_token', '_method']);
        if (!empty($formData)) {
            $details['form_data'] = $formData;
        }

        return $details;
    }
}
