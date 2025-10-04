@extends('layouts.frontend')

@section('content') 
    <div class="card sell-product-panel col-md-offset-1 contact-info-panel">
        <div class="card-body  contact-us-panel text-center">
            <div class="cont-hed">
                <h2 class="hed-txt">{{ env('APP_NAME') }}</h2>
                <p class="sub-hed-txt">Fee free to Contact Us. We are there to help you in any time.</p>
            </div>
            <div class="cont-body">
                <div class="contact-no">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="address">
                                <i class="fa fa-map-marker"></i>
                                {{ $contact_us->address }}
                            </div>
                        </div>
                        <div class="col-md-3 offset-md-3">
                            <h4>{{ $contact_us->name1 }}</h4>
                            <a href="tel:{{ $contact_us->phone1 }}">
                                <h5>
                                    <i class="fa fa-phone"></i>{{ $contact_us->phone1 }}
                                </h5>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <h4>{{ $contact_us->name2 }}</h4>
                            <a href="tel:{{ $contact_us->phone2 }}">
                                <h5>
                                    <i class="fa fa-phone"></i>{{ $contact_us->phone2 }}
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card sell-product-panel col-md-offset-1 contact-info-panel">
        <div class="card-body contact-us-panel text-center">
            <div class="cont-hed">
                <h2 class="hed-txt">Email Address</h2>
            </div>
            <div class="cont-body">
                <ul class="general-ul">
                    <li>
                        Mail us if you have any querries.
                    </li>
                    <li>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:{{ $contact_us->email }}">{{ $contact_us->email }}</a>
                    </li>
                </ul>
            </div>  
        </div>
    </div>

    <div class="card sell-product-panel col-md-offset-1 contact-info-panel">
        <div class="card-body contact-us-panel text-center">
            <div class="cont-hed">
                <h2 class="hed-txt">Social Media</h2>
                <p class="sub-hed-txt">Follow us on Social Media.</p>
                <ul class="sol-list">
                    @isset($contact_us->facebook)
                        <li>
                            <a href="{{ $contact_us->facebook }}" class="facebook-section" target="__blank">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endisset

                    @isset($contact_us->twitter)
                        <li>
                            <a href="{{ $contact_us->twitter }}" class="twitter-section" target="__blank">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endisset
                </ul>
            </div>
        </div>
    </div>

    <div class="card sell-product-panel col-md-offset-1 contact-info-panel viewer-form-panel">
        <div class="card-body contact-us-panel text-center">
            <div class="cont-hed">
                <h2 class="hed-txt">Get In Touch With Us</h2>
                <form action="{{ route('contact-us.send') }}" method="post">
                    @csrf
                    
                    @include('frontend.contact-us._viewer_form')
                    
                    <button type="submit" class="btn btn-success save-btn">
                        Send Message
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection