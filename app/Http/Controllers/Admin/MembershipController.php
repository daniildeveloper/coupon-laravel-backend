<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Mail;

/**
 * membership
 */
class MembershipController extends Controller
{
    public function sendInvite(Request $request)
    {
        $email = $request['email'];
        Mail::send('emails.invite', $data, function ($message) use ($data, $email) {
            $message->from("aigul@chiki-chiki.kz", 'Айгуль из Чики Чики');
            $message->sender("aigul@chiki-chiki.kz", 'Айгуль из Чики Чики');

            $message->to($email);

            $message->subject('Приглашение');

            $message->priority(3);
        });
        return redirect("/backend");
    }
}
