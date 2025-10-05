<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h1 class="card-title h4 mb-0">Complete Your Booking</h1>
                    </div>
                    <div class="card-body p-4">
                        <!-- Price Summary -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h3 class="h5 mb-0">Booking Summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-6">Room Category:</div>
                                    <div class="col-6 text-end fw-semibold">{{ $category->name }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">Check-in:</div>
                                    <div class="col-6 text-end">{{ $request->check_in }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">Check-out:</div>
                                    <div class="col-6 text-end">{{ $request->check_out }}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">Total Nights:</div>
                                    <div class="col-6 text-end">{{ $priceCalculation['total_nights'] }}</div>
                                </div>
                                <hr>
                                <div class="row mb-1">
                                    <div class="col-6">Base Price:</div>
                                    <div class="col-6 text-end">{{ number_format($priceCalculation['base_price'], 2) }} BDT</div>
                                </div>
                                @if($priceCalculation['discount'] > 0)
                                <div class="row mb-1 text-success">
                                    <div class="col-6">Discount (10%):</div>
                                    <div class="col-6 text-end">-{{ number_format($priceCalculation['discount'], 2) }} BDT</div>
                                </div>
                                @endif
                                <div class="row mt-2 pt-2 border-top">
                                    <div class="col-6 fw-bold">Final Amount:</div>
                                    <div class="col-6 text-end fw-bold text-primary fs-5">
                                        {{ number_format($priceCalculation['final_amount'], 2) }} BDT
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Form -->
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="room_category_id" value="{{ $category->id }}">
                            <input type="hidden" name="check_in" value="{{ $request->check_in }}">
                            <input type="hidden" name="check_out" value="{{ $request->check_out }}">

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="customer_name" class="form-label">Full Name</label>
                                    <input type="text" name="customer_name" id="customer_name"
                                           class="form-control @error('customer_name') is-invalid @enderror"
                                           value="{{ old('customer_name') }}" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" name="phone" id="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}"
                                           placeholder="e.g., 01712345678" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Back</a>
                                <button type="submit" class="btn btn-success btn-lg">
                                    Confirm Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
