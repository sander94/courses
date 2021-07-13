<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request)
    {
       // $admins = User::query()->where('is_admin', true)->get();

       // $admins->each(function (User $user) use ($request) {
       //     $user->notify(new ContactNotification($request->get('name'), $request->get('email'), $request->get('text')));
       // });

        


        return redirect()->back()->withSuccess('Aitäh! Sõnum on edastatud!');
}

}