<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return view('admin.login');
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required'
            ]
        ]);

        $email = $request->get('email');
        $password = $request->get('password');


        if (Auth::guard('company')->attempt(['email' => $email, 'password' => $password], true)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function profile(Request $request)
    {
        $company = $request->user();

        $regions = Region::all();

        return view('admin.profile', compact('company', 'regions'));
    }

    public function update(UpdateRequest $request)
    {
        /** @var Company $company */
        $company = $request->user();

        $company->update($request->validated());

        if ($request->has('cover')) {
            $company->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        return redirect()->back()
            ->with('success', 'Company updated');
    }

    public function statistics(Request $request)
    {
        /** @var Company $company */
        $company = $request->user();

        $views = DB::table('views')
            ->where('viewable_type', Company::class)
            ->where('viewable_id', $company->getKey())
            ->select(DB::raw('count(*) as `views`'), DB::raw('DATE(viewed_at) date'))
            ->groupby('date')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->date)->format('M');
            });

        return view('admin.statistics', compact('views'));
    }

    public function description(Request $request)
    {
        /** @var Company $company */
        $company = $request->user();

        return view('admin.description', compact('company'));
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->to('/');
    }

}
