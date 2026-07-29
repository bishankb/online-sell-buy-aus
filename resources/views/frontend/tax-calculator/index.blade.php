@extends('layouts.frontend')

@section('content')
	<div class="card term-panel mb-3">
		<div class="card-header text-center">
        	<h1>Tax Calculator</h1>

    	</div>
		<form action="{{ route('frontend.tax-calculator') }}" method="POST">
        @csrf
            <div class="card-body">
                <div class="form-group required {{ $errors->has('income') ? ' has-error' : '' }} clearfix ">
				    <label for="income" class="form-label">Enter your income for this financial year</label>
				    
				    <input type="number" step="any" name="income" value="{{ old('income', $income ?? '') }}" class="form-control" required> 

				    @if ($errors->has('income'))
				        <span class="help-block">
				            <strong>{{ $errors->first('income') }}</strong>
				        </span>
				    @endif
				</div>
            </div>
            <div class="card-footer" style="background: #fff;">
                <button type="submit" class="btn btn-success save-btn">
                    Calculate
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </form>
        @isset($taxableIncome)
	        <div class="callout callout-info">
	            <h4 style="font-size: 16px;">Your tax is {{ Number::currency($taxableIncome, 'AUD') }} for income {{ Number::currency($income, 'AUD') }}</h4>
	        </div>
        @endisset
	</div>
@endsection
