@extends('web.layouts.app')
@section('title', 'Payment Method')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    body {
        background: url('https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
        background-size: cover;
    }

    .glass-card {
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 30px;
        color: white;
        height: 100%;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }
    p {
        margin-bottom: 0px!important;
    }
    .light-card {
        background-color: #ffffffd9;
        border-radius: 12px;
        padding: 25px;
        color: #000;
        height: 100%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .form-check img {
        max-height: 50px;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .glass-card,
        .light-card {
            margin-bottom: 30px;
            height: auto !important;
        }
    }
</style>

<div class="container py-5 mt-5">
    <form id="orderForm" action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-12 col-lg-4">
                <div class="glass-card h-auto d-flex flex-column justify-content-center">
                    <h2 class="mb-4 border-bottom pb-2">{{ $product->product_name }}</h2>
                    <div class="text-sm text-white">
                        <p><span class="fw-bold text-info">🎮 Game:</span> {{ $product->game->name }}</p>
                        <p><span class="fw-bold text-warning">💵 Price:</span> {{ $product->price }} BDT</p>
                        <p><span class="fw-bold text-danger">🎯 Discount:</span> {{ $product->discount ?? 0 }}%</p>
                        <p><span class="fw-bold text-warning">💵 Final Price:</span>
                            {{ $product->price - ($product->price * ($product->discount ?? 0) / 100) }} BDT
                        </p>
                        <p>
                            <span class="fw-bold text-danger">📋 Instructions:</span><br>
                            <span class="whitespace-pre-line">{{ $product->instructions }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="glass-card">
                    <h3 class="mb-4">PAYMENT METHOD</h3>

                    <div class="row row-cols-3 g-2 mb-4">
                        @php
                            $paymentOptions = [
                                ['id' => 'bkash', 'image' => 'bikash.svg'],
                                ['id' => 'nagad', 'image' => 'nogod.png'],
                                ['id' => 'rocket', 'image' => 'roket3.png'],
                            ];
                        @endphp

                        @foreach ($paymentOptions as $index => $method)
                            <div class="col text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="{{ $method['id'] }}" value="{{ $method['id'] }}" @if($index === 0) checked @endif>
                                    <label class="form-check-label" for="{{ $method['id'] }}">
                                        <img src="{{ asset('fontend/images/payments/' . $method['image']) }}" alt="{{ $method['id'] }}" class="img-fluid">
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-light text-dark p-3 border rounded mb-4" style="font-size: 15px;" id="paymentInstructions"></div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6"><input type="email" class="form-control" placeholder="Email" name="email" required></div>
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Game UID" name="game_uid" required></div>
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Sender Number" name="sender_number" required></div>
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="Transaction ID" name="transaction_id" required></div>
                    </div>

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="game_id" value="{{ $product->game->id }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="discount" value="{{ $product->discount ?? 0 }}">

                    <div id="submitSection">
                        <button type="submit" class="btn btn-success w-100">PLACE ORDER</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- jQuery, Validate, SweetAlert -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const instructionBox = document.getElementById('paymentInstructions');
    const instructions = {
        bkash: `<p>📌 বিকাশে টাকা পাঠানোর জন্য *247# ডায়াল করুন অথবা অ্যাপ ব্যবহার করুন।</p><p>Send Money > 01888794781 > amount > reference (1234)</p>`,
        nagad: `<p>📌 নগদে পাঠাতে *167# ডায়াল করুন অথবা অ্যাপ ব্যবহার করুন।</p><p>Send Money > 01888794781 > amount > reference (1234)</p>`,
        rocket: `<p>📌 রকেট পাঠাতে *322# ডায়াল করুন অথবা অ্যাপ ব্যবহার করুন।</p><p>Send Money > 01742853815 > amount > reference (1234)</p>`
    };

    instructionBox.innerHTML = instructions['bkash'];
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function () {
            instructionBox.innerHTML = instructions[this.value];
        });
    });

    $(document).ready(function () {
        $('#orderForm').validate({
            submitHandler: function (form) {
                const formData = new FormData(form);
                $.ajax({
                    url: form.action,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submitSection button').prop('disabled', true).text('Placing...');
                    },
                    success: function (response) {
                        // Redirect on successful order
                        window.location.href = "{{ route('order.success') }}";
                    },
                    error: function (xhr) {
                        let errorMessage = 'There is a problem, Please try again.';
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).map(err => err[0]).join('\n');
                        }
                        Swal.fire('Error!', errorMessage, 'error');
                    },
                    complete: function () {
                        $('#submitSection button').prop('disabled', false).text('PLACE ORDER');
                    }
                });
                return false; // Prevent default form submission
            }
        });
    });
</script>

@endsection
