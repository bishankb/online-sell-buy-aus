<div class="myaccount-main-nav">
    <ul class="myaccount-main-list">
        <li class="{{ Request::is('my-account/dashboard') ? 'active' : '' }}">
        	<a href="{{ route('my-account.index') }}"><i class="fa fa-home"></i>Overview</a>
        </li>

        <li class="{{ Request::is('my-account/dashboard/product-section*') ? 'active' : '' }}">
        	<a href="{{ route('product-section.index') }}"><i class="fa fa-shopping-cart"></i>My Products</a>
        </li>

        <li class="{{ Request::is('my-account/dashboard/saved-products*') ? 'active' : '' }}">
            <a href="{{ route('saved-product.index') }}"><i class="fa fa-bookmark"></i>Saved Products</a>
        </li>

        <li class="{{ Request::is('my-account/dashboard/buyer-question*') ? 'active' : '' }}">
            <a href="{{ route('buyer-question.index') }}"><i class="fa fa-question-circle"></i>Buyer Questions</a>
        </li>

        <li class="{{ Request::is('my-account/dashboard/your-question*') ? 'active' : '' }}">
            <a href="{{ route('your-question.index') }}"><i class="fa fa-question"></i>Your Questions</a>
        </li>

        <li class="{{ Request::is('my-account/dashboard/notification*') ? 'active' : '' }}">
            <a href="{{ route('notification.view-notification') }}"><i class="fa fa-bell"></i>Notifications</a>
        </li>

        <li class="{{ Request::is('my-account/dashboard/profile*') ? 'active' : '' }}">
            <a href="{{ route('my-account.showProfile') }}"><i class="fa fa-user"></i>Profile</a>
        </li>
        
        <li class="{{ Request::is('my-account/dashboard/change-password*') ? 'active' : '' }}">
            <a href="{{ route('my-account.changePassword') }}"><i class="fa fa-cogs"></i>Change Password</a>
        </li>
    </ul>
</div>
