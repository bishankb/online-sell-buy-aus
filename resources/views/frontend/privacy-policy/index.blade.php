@extends('layouts.frontend')

@section('content')
	<div class="page-grid panel panel-default term-panel">
		<div class="panel-body">
			<h2 class="text-center">Privacy Policy</h2>
			<p>
				This Privacy Policy describes how your personal information is collected, used, and shared when you buy or sell products from {{ env('APP_URL') }}. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.
			</p>

			<div class="paragraph-section" style="padding-top: 0">
				<h4>Personal Information We Collect</h4>
				<p>
					When you visit the Site, we automatically collect certain information about your device, including information about your web browser, IP address, time zone, and some of the cookies that are installed on your device. While registering on our site, as appropriate, you may be asked to enter your name, email address, phone number, address and other details to help you with your experience.
				</p>

				<p>
					We collect Device Information using the following technologies:
					<ul>
						<li>Cookies are data files that are placed on your device or computer and often include an anonymous unique identifier. For more information about cookies, and how to disable cookies, visit https://www.allaboutcookies.org.</li>
    					<li>Log files track actions occurring on the Site, and collect data including your IP address, browser type, Internet service provider, referring/exit pages, and date/time stamps.</li>
					</ul>
				</p>
			</div>

			<div class="paragraph-section">
				<h4>How do we use your personal information?</h4>
				<p>
					We use the Order Information that we collect generally to fulfill any orders placed through the Site (including processing your payment information, arranging for shipping, and providing you with invoices and/or order confirmations).
					Additionally, we use this Order Information to:
					<ul>
						<li>Communicate with you.</li>
						<li>Screen our orders for potential risk or fraud.</li>
						<li>Improve and optimize our Site (for example, by generating analytics about how our customers browse and interact with the Site.</li>
						<li>Assess the success of our marketing and advertising campaigns</li>
					</ul>
				</p>
			</div>

			<div class="paragraph-section">
				<h4>Third-party disclosure</h4>
				<p>
					We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information obtained while registering with {{ env("APP_NAME") }}.
				</p>
			</div>

			<div class="paragraph-section">
				<h4>Advertisment</h4>
				<p>
					We use Google AdSense Advertising on our website.Google, as a third-party vendor, uses cookies to serve ads on our site. Google's use of the DART cookie enables it to serve ads to our users based on previous visits to our site and other sites on the Internet. Users may opt-out of the use of the DART cookie by visiting the Google Ad and Content Network privacy policy.
				</p>

				<p>
					Google's advertising requirements can be summed up by Google's Advertising Principles. They are put in place to provide a positive experience for users.
				</p>
			</div>
		    
		    <div class="paragraph-section">
		        <h4>California Online Privacy Protection Act</h4>
		        <p>
		        	CalOPPA is the first state law in the nation to require commercial websites and online services to post a privacy policy. The law's reach stretches well beyond California to require any person or company in the United States (and conceivably the world) that operates websites collecting Personally Identifiable Information from California consumers to post a conspicuous privacy policy on its website stating exactly the information being collected and those individuals or companies with whom it is being shared.

		        	See more at:
		        	<a target="__blank" href="https://consumercal.org/california-online-privacy-protection-act-caloppa/#sthash.0FdRbT51.dpuf">https://consumercal.org/california-online-privacy-protection-act-caloppa/#sthash.0FdRbT51.dpuf</a>
				</p>
			</div>

			<div class="paragraph-section">
				<h4>COPPA (Children Online Privacy Protection Act)</h4>
				<p>
					When it comes to the collection of personal information from children under the age of 13 years old, the Children's Online Privacy Protection Act (COPPA) puts parents in control. The Federal Trade Commission, United States' consumer protection agency, enforces the COPPA Rule, which spells out what operators of websites and online services must do to protect children's privacy and safety online.We do not specifically market to children under the age of 13 years old.
				</p>
			</div>

			<div class="paragraph-section">
				<h4>Fair Information Practices</h4>
				<p>
					The Fair Information Practices Principles form the backbone of privacy law in the United States and the concepts they include have played a significant role in the development of data protection laws around the globe. Understanding the Fair Information Practice Principles and how they should be implemented is critical to comply with the various privacy laws that protect personal information.
				</p>
			</div>

			<div class="paragraph-section">
				<h4>Data Retention</h4>
				<p>
					When you be member of our Site, we will maintain your Trade Information for our records unless and until you ask us to delete this information.
				</p>
			</div>

			<div class="paragraph-section">
				<h4>Changes</h4>
				<p>
					We may update this privacy policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal or regulatory reasons.
				</p>
			</div>

			<div class="paragraph-section">
				<h4>Contact Information</h4>
				<p>
					Mail us at <a href="mailto{{ $contact_us->email }}">{{ $contact_us->email }}</a>
				</p>

				<p>
					Or. Directly call us at <a href="tel:{{ $contact_us->phone1 }}">{{ $contact_us->phone1 }}</a>, <a href="tel:{{ $contact_us->phone1 }}">{{ $contact_us->phone2 }}</a>
				</p>

				<p>
					{{ env('APP_NAME') }}
				</p>
			</div>
	    </div>
	</div>
@endsection
