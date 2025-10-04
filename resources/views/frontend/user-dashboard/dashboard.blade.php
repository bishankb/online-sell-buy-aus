@extends('layouts.user-dashboard')

@section('user-dashboard-content')
	<div class="user-dashboard-body">
	    <h2>Welcome to User Dashboard</h2>
	    <p>
	    	Dear <b>{{ Auth()->user()->name }}</b>, from this dashboard you can manage your products, view the querries, reply buyer querries and udate your info.<br>
	    </p>
	    <h3>Account Status</h3>
    	<table>
			<tbody>
				<tr>
					<td class="td-header">Total Products posted:</td>
					<td>{{ $totalProduct }}</td>
				</tr>
				<tr>
					<td class="td-header">Total Products for sell:</td>
					<td>{{ $activeProduct }}</td>
				</tr>
				<tr>
					<td class="td-header">Total Products Sold:</td>
					<td>{{ $soldProduct }}</td>
				</tr>
				<tr>
					<td class="td-header">Total Expired Product:</td>
					<td>{{ $expiredProduct }}</td>
				</tr>
				<tr>
					<td class="td-header">New Message From Buyers:</td>
					<td>
						{{ $newBuyerMessageCount }} 
							@if($newBuyerMessageCount > 0) 
								<b><a class="red-color underline" href="{{ route('buyer-question.index') }}" target="__blank">  View Message</a></b> 
							@endif
					</td>
				</tr>
				<tr>
					<td class="td-header">New Reply From Seller:</td>
					<td>
						{{ $newSellerReplyCount }} 
							@if($newSellerReplyCount > 0) 
								<b><a class="red-color underline" href="{{ route('your-question.index') }}" target="__blank">  View Reply</a></b> 
							@endif
					</td>
				</tr>
				<tr>
					<td class="td-header">New Reply From Admin:</td>
					<td>
						{{ $newAdminSellerReplyCount }} 
							@if($newAdminSellerReplyCount > 0) 
								<b><a class="red-color underline" href="{{ route('your-question.index') }}" target="__blank">  View Reply</a></b> 
							@endif
					</td>
				</tr>
				<tr>
					<td class="td-header">Member Since</td>
					<td>{{ Auth::user()->created_at->format('d M, Y') }}</td>
				</tr>
			</tbody>
		</table>
	</div>
@endsection
