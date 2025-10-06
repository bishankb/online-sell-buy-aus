<div class="header" id="myHeader">
	<div class="top-header">
		<div class="container">
			<div class="top-header-left">
				<ul class="support">
					<li><a href="#"><label> </label></a></li>
					<li><a href="{{ route('frontend.home') }}"><i class="fa fa-home"></i>Home</span></a></li>
				</ul>
			</div>
			<div class="top-header-right">
			 	<ul class="support">
					<li><a href="#"><label> </label></a></li>
					<li><a href="{{ route('frontend.faq') }}"><i class="fa fa-question-circle"></i>FAQ</span></a></li>
				</ul>
				<ul class="support" style="margin-left: 25px;">
					<li><a href="#"><label> </label></a></li>
					<li><a href="{{ route('contact-us.index') }}"><i class="fa fa-phone"></i>Contact Us</span></a></li>
				</ul>
				<div class="clearfix"> </div>	
			</div>
			<div class="clearfix"> </div>		
		</div>
	</div>
	<div class="bottom-header">
		<div class="container">
			<div class="header-bottom-left">
				<div class="logo">
					<a href="{{ route('frontend.home') }}"><img src="{{ asset('frontend-template/img/logo1.png') }}" alt=" " /></a>
				</div>

  				<!--Mobile Screen-->
				<div class="mobile-login-section">
					@if (Auth::user())
						<ul class="login notify-bell">
	                        <li class="dropdown notification-btn">
					      		<a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="nav_notification">
	                                <i class="fa fa-bell" aria-hidden="true"></i>
	              					@if(Auth::user()->unreadNotifications->count())
	                                    <b class="badge badge-custom" style="">{{ Auth::user()->unreadNotifications->count() }}</b>
	                                @endif
	                            </a>
	                            <ul class="dropdown-menu notify-drop custom-dropdown">
	                                <div class="notify-drop-title">
                                        <strong>Notification(s)</strong>
                                        @if(Auth::user()->unreadNotifications->count() >0)
                                            <a style="float: right;" href="{{ route('notification.mark-read') }}"title="Mark All Notification as Read">
							                    <span class="badge bg-danger">Clear All</span>
							                </a>
                                        @endif
	                                </div>
	                                <div class="drop-content">
	                                    @foreach(Auth::user()->unreadNotifications->take(10) as $unreadNotification) 
	                                        @if(isset($unreadNotification->data['message']))
							                    <li>
                                					@if(isset($unreadNotification->data['url']))
							                      	  <a style="padding: 0 !important;" href="{{ url($unreadNotification->data['url']). '?' . http_build_query(['notify_id' => $unreadNotification->id])}}">
							                        		<p>{{ $unreadNotification->data['message'] }}</p
							                        			>
							                        	</a>
							                        @endif
							                    </li>
							               	@endif
	                                    @endforeach
	                                </div>
	                                <div class="notify-drop-footer text-center" style="clear: both;">
	                                    <a href="{{ route('notification.view-notification') }}">
	                                        <i class="fa fa-eye"></i> See All
	                                    </a>
	                                </div>
	                            </ul>
	                        </li>
						</ul>
						<ul class="login">
					      	<li class="dropdown">
					      		<a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="userDropdown" aria-expanded="false">
					      			@if(isset( Auth::user()->profile->image->filename))
	                					<img src="/storage/media/user/{{ Auth::user()->id }}/thumbnail/{{ Auth::user()->profile->image->filename }}" alt="User Image" class="user-image">
					      			@else 
					      				<span> <i class="fa fa-user"></i></span>
					      			@endif
					      		</a>
						        <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
									@can('view_dashboards')
										<li>
										    <a class="dropdown-item" href="{{ route('backend.dashboard') }}" target="_blank">Dashboard</a>
										</li>
									@endcan
							        <li><a class="dropdown-item" href="{{ route('my-account.index') }}">My Account</a></li>
						          	<li>
										<a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
						        </ul>
							</li>
						</ul>

					@else
						<ul class="login" style="margin-left: 22px; width: 8%">
							<li><a href="{{ route('login') }}"><span> <i class="fa fa-lock"></i></span></a></li>
						</ul>
					@endif
					<div class="account">
						<a href="{{ route('product-section.addCategories') }}">
							<span> <i class="fa fa-shopping-cart"></i></span>
						</a>
					</div>
				</div>
  				<!--Mobile Screen-->

				<div class="search">
					<form method="GET" action="{{ route('product.search') }}">
						@if(Request('search_product'))
							<input type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" name="search_product" value="{{Request('search_product')}}" required>
						@else 
							<input type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" name="search_product" required placeholder="Search Product">
						@endif
						<input type="submit" value="SEARCH">
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>

			<!--Large Screen-->
			<div class="login-section">					
				@if (Auth::user())
					<ul class="login">
                        <li class="dropdown notification-btn">
				      		<a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="nav_notification">
                                <i class="fa fa-bell" aria-hidden="true"></i>
              					@if(Auth::user()->unreadNotifications->count())
                                    <b class="badge badge-custom" style="">{{ Auth::user()->unreadNotifications->count() }}</b>
                                @endif
                            </a>
                            <ul class="dropdown-menu notify-drop custom-dropdown">
                                <div class="notify-drop-title text-center">
                                        <strong>Notification(s)</strong>
                                        @if(Auth::user()->unreadNotifications->count() >0)
                                                <a href="{{ route('notification.mark-read') }}"title="Mark All Notification as Read">
								                    <span class="badge bg-danger">Clear All</span>
								                </a>
                                        @endif
                                </div>
                                <div class="drop-content">
                                    @foreach(Auth::user()->unreadNotifications->take(10) as $unreadNotification) 
                                        @if(isset($unreadNotification->data['message']))
						                    <li>
                            					@if(isset($unreadNotification->data['url']))
						                        	<a style="padding: 0 !important;" href="{{ url($unreadNotification->data['url']). '?' . http_build_query(['notify_id' => $unreadNotification->id])}}">
						                        		<p>{{ $unreadNotification->data['message'] }}</p>

						                        	</a>                    	
						                        @endif
						                    </li>
						               	@endif
                                    @endforeach
                                </div>
                                <div class="notify-drop-footer text-center" style="clear: both;">
		                            <a href="{{ route('notification.view-notification') }}">
                                        <i class="fa fa-eye"></i> See All Notification
                                    </a>
                                </div>
                            </ul>
                        </li>
					</ul>

					<ul class="login">
				      	<li class="dropdown">
				      		<a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="userDropdown" aria-expanded="false">
				      			@if(isset( Auth::user()->profile->image->filename))
                					<img src="/storage/media/user/{{ Auth::user()->id }}/thumbnail/{{ Auth::user()->profile->image->filename }}" alt="User Image" class="user-image">
				      			@else 
				      				<span> <i class="fa fa-user"></i></span>
				      			@endif
				      			{{ Str::limit(auth()->user()->name, $limit = 7, $end = '...')  }}

				      		</a>
					        <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
								@can('view_dashboards')
									<li>
									    <a class="dropdown-item" href="{{ route('backend.dashboard') }}" target="_blank">Dashboard</a>
									</li>
								@endcan
							    <li><a class="dropdown-item" href="{{ route('my-account.index') }}">My Account</a></li>
					          	<li>
									<a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</li>
					        </ul>
						</li>
					</ul>
				@else
					<ul class="login">
						<li><a href="{{ route('login') }}"><span> <i class="fa fa-lock"></i></span>LOGIN</a></li> |
						<li ><a href="{{ route('register') }}">SIGNUP</a></li>
					</ul>
				@endif
				<div class="account">
					<a href="{{ route('product-section.addCategories') }}">
						<span> <i class="fa fa-shopping-cart"></i></span>
						Sell Your Product
					</a>
				</div>
			</div>
			<!--Large Screen-->

			<div class="clearfix"> </div>	
		</div>
	</div>
</div>

