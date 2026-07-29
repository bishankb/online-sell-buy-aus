<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SEOMeta;
use OpenGraph;

class TaxCalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->seoFaq();

        $taxableIncome = null; // default
        $income = $request->input('income');
        
        // Only calculate if form was submitted
        if ($request->isMethod('post')) {
            $request->validate([
                'income' => 'required|numeric|min:0',
            ]);

            $taxableIncome = $this->calculateTax($income);
        }

        return view('frontend.tax-calculator.index', compact('income', 'taxableIncome'));
    }

    //Calulate the tax according to the income
    private function calculateTax($taxableIncome)
    {
        if ( $taxableIncome <= 18200 ) {
            $taxableIncome = 0;
        } else if($taxableIncome >= 18201 && $taxableIncome <= 37000) {
            $taxableIncome = ($taxableIncome - 18200) * 0.19 +0;
        } else if($taxableIncome >= 37001 && $taxableIncome <= 87000) {
            $taxableIncome = ($taxableIncome - 37000) * 0.325 + 3572;
        } else if($taxableIncome >= 87001 && $taxableIncome <= 180000) {
            $taxableIncome = ($taxableIncome - 87000) * 0.37 + 19822;
        } else if($taxableIncome >= 180001) {
            $taxableIncome = ($taxableIncome - 180000) * 0.45 + 54097;
        }

        return $taxableIncome;
    }

    private function seoFaq()
    {
        SEOMeta::setTitle('FAQ -'.env('APP_NAME'));
        SEOMeta::setDescription('Frequently Ask Questions on '.env('APP_NAME').'. Fee to free to contact us if any problems');
        SEOMeta::setCanonical(route('frontend.faq'));
        SEOMeta::addKeyword(['osbaustralia', 'faq', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);
        
        OpenGraph::setTitle('FAQs. -'.env('APP_NAME'));
        OpenGraph::setDescription('Frequently Ask Questions on '.env('APP_NAME').'. Fee to free to contact us if any problems');
        OpenGraph::setUrl(route('frontend.faq'));
    }
}
