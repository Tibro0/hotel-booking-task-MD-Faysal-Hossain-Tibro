<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="card-title text-center mb-0">Hotel Booking System</h1>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('bookings.check-availability') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="check_in" class="form-label">Check-in Date</label>
                                    <input type="text" name="check_in" value="{{ old('check_in') }}" id="check_in" class="form-control @error('check_in') is-invalid @enderror" required
                                        readonly>
                                    @error('check_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="check_out" class="form-label">Check-out Date</label>
                                    <input type="text" name="check_out" value="{{ old('check_out') }}" id="check_out" class="form-control @error('check_out') is-invalid @enderror" required
                                        readonly>
                                        @error('check_out')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Check Availability
                                </button>
                            </div>
                        </form>

                        <div class="mt-5">
                            <h2 class="h4 mb-3">Room Categories & Base Prices</h2>
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">{{ $category->name }}</h5>
                                                <p class="card-text text-muted">
                                                    {{ number_format($category->base_price, 2) }} BDT/night
                                                </p>
                                                <small class="text-muted">{{ $category->room_count }} rooms
                                                    available</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script>
        flatpickr('#check_in', {
            minDate: 'today',
            dateFormat: 'Y-m-d',
            disable: [
                @foreach ($fullyBookedDates as $date)
                    "{{ $date }}",
                @endforeach
            ]
        });

        flatpickr('#check_out', {
            minDate: 'today',
            dateFormat: 'Y-m-d',
            disable: [
                @foreach ($fullyBookedDates as $date)
                    "{{ $date }}",
                @endforeach
            ]
        });
    </script>
</body>

</html>
