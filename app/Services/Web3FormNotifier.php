<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Web3FormNotifier
{
    public static function sendOrderCreated($order)
    {
        $userName = $order->user->name ?? 'N/A';
        $userEmail = $order->email ?? 'N/A';
        $gameName = $order->game->name ?? 'N/A';
        $gameUid = $order->game_uid ?? 'N/A';
        $productName = $order->product->product_name ?? 'N/A';
        $originalAmount = $order->priceFormatted ?? number_format($order->price, 2);
        $discount = $order->discountFormatted ?? 'No Discount';
        $finalAmount = $order->finalPriceFormatted ?? number_format($order->price - $order->discount, 2);
        $status = ucfirst($order->status);
        $paymentMethod = $order->payment_method ?? 'N/A';
        $senderNumber = $order->sender_number ?? 'N/A';
        $transactionId = $order->transaction_id ?? 'N/A';
        $createdAt = $order->created_at ? $order->created_at->format('d M Y, h:i A') : 'N/A';

        $message = "🛒 New Order Placed! Order #{$order->id}\n\n"
            . "👤 User: {$userName}\n"
            . "📧 User Email: {$userEmail}\n"
            . "🎮 Game: {$gameName}\n"
            . "🎮 Game UID: {$gameUid}\n"
            . "📦 Product: {$productName}\n"
            . "💰 Original Amount: {$originalAmount}\n"
            . "💸 Discount Applied: {$discount}\n"
            . "💳 Final Amount: {$finalAmount} BDT\n"
            . "📋 Status: {$status}\n"
            . "💳 Payment Method: {$paymentMethod}\n"
            . "📱 Sender Number: {$senderNumber}\n"
            . "🆔 Transaction ID: {$transactionId}\n"
            . "📅 Created At: {$createdAt}";

        return Http::post('https://api.web3forms.com/submit', [
            'access_key' => env('WEB3FORMS_ACCESS_KEY'),
            'subject' => '🛒 New Order Received - Game Topup',
            'from_name' => 'GameTopUp Admin Panel',
            'email' => 'kalachanstore33@gmail.com',
            'message' => $message,
        ]);
    }

    // public static function sendOrderViewed($order)
    // {
    //     $userName = $order->user->name ?? 'N/A';
    //     $userEmail = $order->email ?? 'N/A';
    //     $gameName = $order->game->name ?? 'N/A';
    //     $gameUid = $order->game_uid ?? 'N/A';
    //     $productName = $order->product->product_name ?? 'N/A';
    //     $originalAmount = $order->priceFormatted ?? number_format($order->price, 2);
    //     $discount = $order->discountFormatted ?? 'No Discount';
    //     $finalAmount = $order->finalPriceFormatted ?? number_format($order->price - $order->discount, 2);
    //     $status = ucfirst($order->status);
    //     $paymentMethod = $order->payment_method ?? 'N/A';
    //     $senderNumber = $order->sender_number ?? 'N/A';
    //     $transactionId = $order->transaction_id ?? 'N/A';
    //     $createdAt = $order->created_at ? $order->created_at->format('d M Y, h:i A') : 'N/A';

    //     $message = "🕹️ Order #{$order->id} has been viewed.\n\n"
    //         . "👤 User: {$userName}\n"
    //         . "📧 User Email: {$userEmail}\n"
    //         . "🎮 Game: {$gameName}\n"
    //         . "🎮 Game UID: {$gameUid}\n"
    //         . "📦 Product: {$productName}\n"
    //         . "💰 Original Amount: {$originalAmount}\n"
    //         . "💸 Discount Applied: {$discount}\n"
    //         . "💳 Final Amount: {$finalAmount} BDT\n"
    //         . "📋 Status: {$status}\n"
    //         . "💳 Payment Method: {$paymentMethod}\n"
    //         . "📱 Sender Number: {$senderNumber}\n"
    //         . "🆔 Transaction ID: {$transactionId}\n"
    //         . "📅 Created At: {$createdAt}";

    //     return Http::post('https://api.web3forms.com/submit', [
    //         'access_key' => env('WEB3FORMS_ACCESS_KEY'),
    //         'subject' => 'Order Viewed - Game Topup',
    //         'from_name' => 'GameTopUp Admin Panel',
    //         'email' => 'kalachanstore33@gmail.com',
    //         'message' => $message,
    //     ]);
    // }

    public static function sendOrderCompleted($order)
    {
        $userName = $order->user->name ?? 'N/A';
        $userEmail = $order->email ?? 'N/A';
        $gameName = $order->game->name ?? 'N/A';
        $gameUid = $order->game_uid ?? 'N/A';
        $productName = $order->product->product_name ?? 'N/A';
        $originalAmount = $order->priceFormatted ?? number_format($order->price, 2);
        $discount = $order->discountFormatted ?? 'No Discount';
        $finalAmount = $order->finalPriceFormatted ?? number_format($order->price - $order->discount, 2);
        $status = ucfirst($order->status);
        $paymentMethod = $order->payment_method ?? 'N/A';
        $senderNumber = $order->sender_number ?? 'N/A';
        $transactionId = $order->transaction_id ?? 'N/A';
        $createdAt = $order->created_at ? $order->created_at->format('d M Y, h:i A') : 'N/A';

        $message = "✅ Order #{$order->id} marked as complete.\n\n"
            . "👤 User: {$userName}\n"
            . "📧 User Email: {$userEmail}\n"
            . "🎮 Game: {$gameName}\n"
            . "🎮 Game UID: {$gameUid}\n"
            . "📦 Product: {$productName}\n"
            . "💰 Original Amount: {$originalAmount}\n"
            . "💸 Discount Applied: {$discount}\n"
            . "💳 Final Amount: {$finalAmount} BDT\n"
            . "📋 Status: {$status}\n"
            . "💳 Payment Method: {$paymentMethod}\n"
            . "📱 Sender Number: {$senderNumber}\n"
            . "🆔 Transaction ID: {$transactionId}\n"
            . "📅 Created At: {$createdAt}";

        return Http::post('https://api.web3forms.com/submit', [
            'access_key' => env('WEB3FORMS_ACCESS_KEY'),
            'subject' => '✅ Order Completed - Game Topup',
            'from_name' => 'GameTopUp Admin Panel',
            'email' => 'kalachanstore33@gmail.com',
            'message' => $message,
        ]);
    }
}
