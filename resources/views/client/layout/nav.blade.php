<?php

use Illuminate\Support\Facades\Auth;
?>

<header>
	<div class="row d-inline-flex">
		<a href="{{asset('client/index')}}" class="nav-link logo ml-5 ">
			<img src="{{asset('/images/faces/logo1.jpg')}}" height="60px" width="100px" />
		</a>
		<nav class="navbar ">
			<a class=" btn mr-3 {{(request()->is('client/index')) ? 'active' : '' }}" href="{{asset('client/index')}}">Trang Chủ</a>
			<a href="{{asset('client/ticket')}}" class="btn  mr-3 {{(request()->is('client/ticket*')) ? 'active' : '' }}">
				Đặt vé
			</a>

			<a href="{{asset('client/schedule')}}" class="btn mr-3 {{(request()->is('client/schedule*')) ? 'active' : '' }}">Lịch Trình</a>
			<a href="{{asset('client/introduce')}}" class="btn mr-3 {{(request()->is('client/introduce')) ? 'active' : '' }}">Giới Thiệu</a>
			<a href="#footer_id" class="btn mr-3 ">Liên Hệ</a>
			@if (auth('client')->user())
			<a href="{{asset('client/history/1')}}" class="btn mr-3 {{(request()->is('client/history*')) ? 'active' : '' }} ">Lịch sử</a>
			@endif
		</nav>



		<div class="icons row d-inline-flex right-icon ">

			<!-- <a href="#" class="fas fa-heart"></a> -->

			<i class="fa-solid fa-user mt-3" data-toggle="dropdown"></i>
			<div class="dropdown-menu">
				@if (!auth('client')->user())
				<a class="dropdown-item" href="{{asset('/client/user/login')}}"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
				<a class="dropdown-item" href="{{asset('/client/user/register')}} "><i class="fas fa-check-circle"></i> Đăng ký</a>
				@else

				@foreach ($users as $key => $user)
				@if($user->idnd == auth('client')->user()->idnd)
				<a class="dropdown-item" href=""><i class="fas fa-check-circle"></i>&nbsp;{{$user->tennd}}</a>

				@endif
				@endforeach
				<a class="dropdown-item" href="{{asset('/client/user/logout')}} "><i class="fa-sharp fa-solid fa-right-from-bracket"></i>Đăng xuất</a>
				@endif
			</div>
		</div>

	</div>
</header>

<br><br>