<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body text-center p-5">
                        <div class="text-success mb-4" style="font-size: 4rem;">✓</div>
                        <h1 class="card-title h2 mb-3">Booking Confirmed!</h1>
                        <p class="card-text text-muted mb-4">Thank you for your booking. Here are your booking details:</p>

                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h2 class="h5 mb-0">Booking Details</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                                        <p><strong>Customer Name:</strong> {{ $booking->customer_name }}</p>
                                        <p><strong>Email:</strong> {{ $booking->email }}</p>
                                        <p><strong>Phone:</strong> {{ $booking->phone }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Check-in:</strong> {{ $booking->check_in->format('M d, Y') }}</p>
                                        <p><strong>Check-out:</strong> {{ $booking->check_out->format('M d, Y') }}</p>
                                        <p><strong>Total Nights:</strong> {{ $booking->total_nights }}</p>
                                        <p><strong>Room Category:</strong> {{ $booking->room->category->name }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-top">
                                    <h3 class="h6 mb-3">Price Breakdown</h3>
                                    <div class="row">
                                        <div class="col-6">Base Price:</div>
                                        <div class="col-6 text-end">{{ number_format($booking->base_price, 2) }} BDT</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">Total Amount:</div>
                                        <div class="col-6 text-end">{{ number_format($booking->total_amount, 2) }} BDT</div>
                                    </div>
                                    @if($booking->final_amount < $booking->total_amount)
                                    <div class="row text-success">
                                        <div class="col-6">Discount Applied:</div>
                                        <div class="col-6 text-end">-{{ number_format($booking->total_amount - $booking->final_amount, 2) }} BDT</div>
                                    </div>
                                    @endif
                                    <div class="row mt-2 pt-2 border-top fw-bold">
                                        <div class="col-6">Final Amount:</div>
                                        <div class="col-6 text-end text-primary fs-5">
                                            {{ number_format($booking->final_amount, 2) }} BDT
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h4 class="alert-heading h6">Next Steps</h4>
                            <ul class="list-unstyled mb-0">
                                <li>✓ You will receive a confirmation email shortly</li>
                                <li>✓ Please present your ID at check-in</li>
                                <li>✓ Check-in time is 2:00 PM, check-out is 12:00 PM</li>
                                <li>✓ Contact us if you have any questions</li>
                            </ul>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                                Make Another Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
