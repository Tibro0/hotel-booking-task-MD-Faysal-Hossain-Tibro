<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $categories = RoomCategory::all();
        $fullyBookedDates = $this->bookingService->getFullyBookedDates();

        return view('bookings.index', compact('categories', 'fullyBookedDates'));
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        $availableCategories = $this->bookingService->getAvailableCategories($checkIn, $checkOut);

        return view('bookings.availability', compact('availableCategories', 'checkIn', 'checkOut'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'room_category_id' => 'required|exists:room_categories,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);

        $category = RoomCategory::findOrFail($request->room_category_id);
        $availableRooms = $this->bookingService->getAvailableRooms(
            $category->id,
            $request->check_in,
            $request->check_out
        );

        if ($availableRooms->isEmpty()) {
            return back()->with('error', 'Sorry, no rooms available for the selected dates.');
        }

        $priceCalculation = $this->bookingService->calculatePrice(
            $category,
            $request->check_in,
            $request->check_out
        );

        return view('bookings.create', compact(
            'category',
            'availableRooms',
            'priceCalculation',
            'request'
        ));
    }

    public function store(BookingRequest $request)
    {
        $availableRooms = $this->bookingService->getAvailableRooms(
            $request->room_category_id,
            $request->check_in,
            $request->check_out
        );

        if ($availableRooms->isEmpty()) {
            return back()->with('error', 'Sorry, the selected room is no longer available.');
        }

        $category = RoomCategory::findOrFail($request->room_category_id);
        $priceCalculation = $this->bookingService->calculatePrice(
            $category,
            $request->check_in,
            $request->check_out
        );

        $booking = Booking::create([
            'room_id' => $availableRooms->first()->id,
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_nights' => $priceCalculation['total_nights'],
            'base_price' => $priceCalculation['base_price'],
            'total_amount' => $priceCalculation['total_amount'],
            'final_amount' => $priceCalculation['final_amount'],
            'price_breakdown' => $priceCalculation['price_breakdown'],
        ]);

        return redirect()->route('bookings.thank-you', $booking);
    }

    public function thankYou(Booking $booking)
    {
        return view('bookings.thank-you', compact('booking'));
    }
}
