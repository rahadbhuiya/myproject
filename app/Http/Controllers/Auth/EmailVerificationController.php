<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/email/verified'); // Your custom "verified" page
        }

        $request->fulfill(); // Marks email as verified

        return redirect('/email/verified'); // Redirect after successful verification
    }
}
