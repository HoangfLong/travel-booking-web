<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Services\TourService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $tourService;

    public function __construct(PaymentService $paymentService, TourService $tourService)
    {
        $this->paymentService = $paymentService;
        $this->tourService = $tourService;
    }

    public function checkout(Request $request, $tourId)
    {
        $userId = Auth::id();
        $tour = $this->tourService->getTourById($tourId);
        $guestCount = $request->guest_count;

        if ($guestCount > $tour->available_seats) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough available seats!',
            ], 400);
        }

        $checkoutUrl = $this->paymentService->createCheckoutSession($tourId, $userId, $guestCount);

        return response()->json([
            'success' => true,
            'checkout_url' => $checkoutUrl,
        ]);
    }

    public function success(Request $request)
    {
        $bookingId = $this->paymentService->handlePaymentSuccess(
            $request->tour_id,
            $request->user_id,
            $request->guest_count
        );

        return response()->json([
            'success' => true,
            'booking_id' => $bookingId,
            'message' => 'Payment successful! Check email.'
        ]);
    }

    public function cancel(Request $request)
    {
        $tourId = $request->tour_id;

        return response()->json([
            'success' => false,
            'message' => "Payment for tour #$tourId has been cancelled!",
            'tour_id' => $tourId
        ]);
    }
}
