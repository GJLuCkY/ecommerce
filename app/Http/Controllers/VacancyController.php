<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\VacancyCity;

class VacancyController extends Controller
{
    public function vacancyCity($citySlug) {
        $city = VacancyCity::where('status', 1)->whereSlug($citySlug)->firstOrFail();
        $vacancyCities = VacancyCity::orderBy('lft')->where('status', 1)->get();
        return view('pages.vacancy-city', compact('city', 'vacancyCities'));
    }

    public function vacancyId($citySlug, $vacancyId) {
        $vacancyWithoutFakes = Vacancy::where('id', $vacancyId)->firstOrFail();
        $vacancy = $vacancyWithoutFakes->withFakes();
        $city = VacancyCity::whereSlug($citySlug)->where('status', 1)->firstOrFail();
        $vacancyCities = VacancyCity::orderBy('lft')->where('status', 1)->get();
        return view('pages.vacancy', compact('vacancy', 'city', 'vacancyCities'));
    }

    public function vacancies() {
        $city = VacancyCity::latest()->where('status', 1)->firstOrFail();

        return redirect()->route('vacancy.city', ['citySlug' => $city->slug]);
    }
}
