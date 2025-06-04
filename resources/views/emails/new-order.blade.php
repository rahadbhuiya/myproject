<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Order Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #333;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            max-width: 600px;
            margin: auto;
        }
        .header {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .order-info {
            margin-top: 15px;
        }
        .order-info strong {
            display: inline-block;
            width: 150px;
        }
        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">📦 A new order has been placed!</div>

        <div class="order-info">
            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
            <p><strong>Game UID:</strong> {{ $order->game_uid }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Sender Number:</strong> {{ $order->sender_number }}</p>
            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>Price:</strong> {{ number_format($order->price, 2) }} BDT</p>
            @if ($order->discount)
                <p><strong>Discount:</strong> {{ $order->discount }}%</p>
            @endif
            <p><strong>Final Price:</strong> {{ number_format($order->final_price, 2) }} BDT</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Placed At:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>

        <div class="footer">
            This is an automated email from your system. Please do not reply to this message.
        </div>
    </div>
</body>
</html>
