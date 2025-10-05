<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h1 class="card-title h4 mb-0">Available Rooms</h1>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted mb-4">
                            Check-in: <strong>{{ $checkIn }}</strong> |
                            Check-out: <strong>{{ $checkOut }}</strong>
                        </p>

                        @if ($availableCategories->where('is_available', true)->isEmpty())
                            <div class="text-center py-5">
                                <div class="alert alert-warning">
                                    <h4 class="alert-heading">No rooms available</h4>
                                    <p class="mb-0">Sorry, no rooms are available for the selected dates.</p>
                                </div>
                                <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                                    ← Back to Search
                                </a>
                            </div>
                        @else
                            <div class="row">
                                @foreach ($availableCategories as $available)
                                    @if ($available['is_available'])
                                        <div class="col-md-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                                        <div>
                                                            <h5 class="card-title">{{ $available['category']->name }}
                                                            </h5>
                                                            <p class="card-text text-muted mb-1">
                                                                Base Price:
                                                                {{ number_format($available['category']->base_price, 2) }}
                                                                BDT/night
                                                            </p>
                                                            <span class="badge bg-success">
                                                                {{ $available['available_rooms_count'] }} room(s)
                                                                available
                                                            </span>
                                                        </div>
                                                        <div class="text-end">
                                                            <h4 class="text-primary fw-bold">
                                                                {{ number_format($available['price_calculation']['final_amount'], 2) }}
                                                                BDT
                                                            </h4>
                                                            <small class="text-muted">
                                                                {{ $available['price_calculation']['total_nights'] }}
                                                                night(s)
                                                            </small>
                                                        </div>
                                                    </div>

                                                    @if ($available['price_calculation']['total_nights'] >= 3)
                                                        <div class="alert alert-success py-2">
                                                            <small>🎉 10% discount applied for
                                                                {{ $available['price_calculation']['total_nights'] }}
                                                                consecutive nights!</small>
                                                        </div>
                                                    @endif

                                                    <a href="{{ route('bookings.create', [
                                                        'room_category_id' => $available['category']->id,
                                                        'check_in' => $checkIn,
                                                        'check_out' => $checkOut,
                                                    ]) }}"
                                                        class="btn btn-primary w-100">
                                                        Book Now
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Back to Search</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
