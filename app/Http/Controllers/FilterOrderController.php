<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\FilterService;
use App\Services\NotificationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilterOrderController extends Controller
{
    private FilterService $filterService;
    private NotificationService $notificationService;

    public function __construct(FilterService $filterService, NotificationService $notificationService)
    {
        $this->filterService = $filterService;
        $this->notificationService = $notificationService;
        $this->middleware(['filter.order'])->only(['ordersIndex']);
    }

    /**
     * @throws Exception
     */
    public function ordersIndex(Request $request): JsonResponse
    {
        $request->validate([
            'status' => 'nullable|in:' . implode(',', Order::getStatuses()),
            'nationalCode' => 'nullable|string|max:10',
            'amount.min' => 'nullable|numeric',
            'amount.max' => 'nullable|numeric',
        ]);

        try {
            $filteredQuery = $this->filterService->applyFilters(Order::query(), $request->all());
            $orders = $filteredQuery->get()->map(function (Order $order) {
                return [
                    'id' => $order->id,
                    'equipmentName' => $order->equipment->name,
                    'customerName' => $order->user->name,
                    'customerNationalCode' => $order->user->national_code,
                    'status' => $order->status,
                    'amount' => $order->amount,
                    'createdAt' => $order->created_at
                ];
            })->toArray();
        } catch (Exception $e) {
            $this->notificationService->notifyAdminFromException($e);
            throw new Exception($e->getMessage());
        }

        return response()->json(['orders' => $orders]);
    }
}
