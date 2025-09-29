@extends('layouts.frontend')

@section('content')
	<div class="page-grid panel panel-default term-panel">
		<div class="panel-body">
			<h2 class="text-center">Posting Rules</h2>
			<p>
				Visitors or users in {{ env('APP_NAME') }} ({{ env('APP_FULL_NAME') }}) who wants be member of our group must follow these rules compulsorily before posting their products. We do not allow posting of products that are considered illegal in our country Nepal. There will be certain consequences if any user is observed violating these rules and regulations.
			</p><br>

			<div class="paragraph-section" style="padding-top: 0">		
				<h4>1) Ambiguous & Deceitful Products</h4>
				<p>
					Products which fall under this rule are as follows:
					<ul>
						<li>Stolen and Illegal goods.</li>
						<li>Fake, Replica of geniune goods by representing them as original.</li>
						<li>Products title, price and description must be related. For instance, posting product with title Telivision with irrelevant price Rs. 100 or Rs. 25000000 or giving description about cars is not allowed.</li>
						<li>Products title should not include other detail such as "Price" or "Phone numbers", there is separate field for that.</li>
						<li>Products with incorrect condition type. For instance, posting used goods as Brand New, but selling used or damage products.</li>
						<li>Products with sole purpose of leading user to another website or generate downloads without actual sale of product or service.</li>
						<li>Products which have Images unrelated with the product content. Posting graphic (violent or adult oriented) images are not allowed.</li>
					</ul>
				</p>
			</div>


			<div class="paragraph-section">
				<h4>2) Multiple product posting.</h4>
				<p>
					Users are prohibited to post same product more than once until they are displayed on the active list. There should not be any duplication of the similar product by changing the images from similar account or different account
				</p>

				<p>
					Users are only allowed to post similar products if the previous one has been marked as sold, has been deleted or has already expired.
				</p>
			</div>

			<div class="paragraph-section">
				<h4>3) Posting Illegal Products.</h4>
				<p>
					Products which fall under this rule are as follows:
					<ul>
						<li>Weapons, drugs, human organs, endangered animals, prohibited antiques, black marketing, etc.</li>
						<li>Flammable, toxic or poisonous products</li>
						<li>Products that are prohibited by Nepalese law.</li>
						<li>Adult entertainment products like escort, prostituion, indecent massages, pornography, sexual items, etc.</li>
						<li>Products that can harm any person, group, religion, other third parties intellectual property, moral right and privacy.</li>
					</ul>
				</p>
			</div>

			<div class="paragraph-section">
				<h4>4) Posting Products in wrong category and sub-category.</h4>
				<p>
					Correct category as well as sub-category must be selected before posting a product. For e.g. posting a Samsung Galaxy S7 in Automobile category or in Telivision sub-category is considered as mis-categorized product. If your product falls under more than one category or subcategory, select the best option as far as possible or contact us. And if you are unable to find suitable category for your product list them in other.
				</p>
			</div>
	    
		    <div class="paragraph-section">
		        <h4>Consequences on Abuse of Posting Rules. </h4>
		        <p>
		        	Users who offense the above mentioned posting rules and regulations may be subjected to any of the following actions:
		        	<ul>
		        		<li>You may received warning from the site owner or admin about the violation of rules.</li>
		        		<li>Your product(s) that has violated our rules may be deleted with/without prior notice.</li>
		        		<li>You maybe asked to provide identification documents.</li>
		        		<li>You may be temporarily or permanently blocked from access to our site.</li>
		        		<li>You may be reported to Law Enforcement Agency or Appropriate Authorities based on the unlawful act you have made.</li>
		        	</ul>
		        </p>
			</div>

			<hr>

			<h2 class="text-center">Safety Tips</h2>
			<p>
				{{ env('APP_NAME') }} ({{ env('APP_FULL_NAME') }}) is an online buy and sell platform for buying the interested products directly from seller and selling your brand new or used  products. It is always necessary to take some precaution before making any deal. Below are some several safety guidelines for seller as well as for buyer.
			</p><br>

			<div class="paragraph-section" style="padding-top: 0">

				<div class="paragraph-section">
					<h4>1) Check the product accurately.</h4>
					<p>
						Before contacting the seller please check the product details and descriptions throughly. You have to be extracareful when you survey the product before making payment. Take your time to check the item and do not rush if told by its seller. Cancel the deal if you found that item inaccurate as you have right to do so.
					</p>
				</div>

				<h4>2) Avoid fraud & scams</h4>
				<p>
					 Make yourself aware of common scams and fraud practices. Ask any querries you have about the product to its seller. You should be cautious of:
					<ul>
						<li>Seller that demands you to make payment in advance.</li>
						<li>Expensive products with low price. For instance, Iphone 7 having price Rs2000 is suspicious</li>
						<li>Seller may try to sell stolen goods at low prices. It is necessary to ask for documents which shows proof of purchase (like bill, warranty card).</li>
						<li>Seller who mentioned their contact number in other fields such as title or description.</li>
					</ul>					
				</p>
			</div>

			<div class="paragraph-section">
				<h4>3) Try to meet the individual (buyer or seller) at a public place.</h4>
				<p>
					For your personal safety, always meet buyer/seller in public places where other people are present. Do not arrange meeting at isolated places. If required, make sure you are not alone.
				</p>

				<p>
					Ask the person you are dealing with  about his personal info before meeting. You may also ask about his geniune identification documents such as citizenship or license.
				</p>

				<p>
					Always carry a mobile with you. Do inform someone from your family or friend about the deal you are goining to do.
				</p>
			</div>

			<div class="paragraph-section">
				<h4>4) Expensive product deal</h4>
				<p>
					If the item is of high price, it is advisable to make payment through banks. Do not make advance payment. Always keep photocopies of deposit slips and cheques. Similarly, sellers are advised not to dispatch goods before receiving payment from buyer. 
			</div>

			<div class="paragraph-section">
				<h4>5) Report Us</h4>
				<p>
					If you observed any suspicious products, please inform to local authorities us, we will take action suddenly.
				</p>
			</div>
	    </div>
	</div>
@endsection
