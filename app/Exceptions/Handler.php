<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
//    public function render($request, Exception|Throwable $exception)
//    {
//        // Kiểm tra lỗi 500 (Internal Server Error)
//        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
//            if ($exception->getStatusCode() === 500) {
//                // Trả về lỗi 500 dưới dạng JSON nếu là yêu cầu AJAX
//                if ($request->ajax()) {
//                    return response()->json(['error' => 'Đã xảy ra lỗi hệ thống, vui lòng thử lại sau!'], 500);
//                }
//                // Nếu không phải AJAX, tiếp tục xử lý như bình thường
//                return response()->view('errors.500', [], 500);
//            }
//
//            // Xử lý lỗi 404 và 403 tương tự nếu là yêu cầu AJAX
//            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
//                if ($request->ajax()) {
//                    return response()->json(['error' => 'Trang không tìm thấy!'], 404);
//                }
//                return response()->view('errors.404', [], 404);
//            }
//
//            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\ForbiddenHttpException) {
//                if ($request->ajax()) {
//                    return response()->json(['error' => 'Bạn không có quyền truy cập!'], 403);
//                }
//                return response()->view('errors.403', [], 403);
//            }
//        }
//
//        return parent::render($request, $exception);
//    }
}
