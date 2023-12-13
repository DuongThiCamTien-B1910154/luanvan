<?php

use Illuminate\Support\Facades\Auth;
?>
<style>
	.topnav a {
		float: left;
		display: block;
		color: black;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 17px;
	}

	.topnav a:hover {
		background-color: #ddd;
		color: black;
	}

	.topnav input[type=text] {
		float: right;
		padding: 6px;
		margin-top: 5px;
		margin-right: 16px;
		border: none;
		font-size: 17px;
	}

	/* dropdown */
	.dropdown {
		position: relative;
		display: inline-block;
	}

	.dropdown-content {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 160px;
		box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
		z-index: 1;
	}

	.dropdown-content a {
		color: black;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
	}

	.dropdown-content a:hover {
		background-color: #f1f1f1
	}

	.dropdown:hover .dropdown-content {
		display: block;
	}

	.dropdown:hover .dropbtn {
		background-color: #3e8e41;
	}
</style>
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
			<!-- 
			<div class="topnav">
				<span><i class="fa fa-search"></i></span>
				<input type="text" placeholder="Điểm đến...">
			</div> -->
			<form class="dropdown" action="" enctype=" multipart/form-data">
				@csrf
				<div class="input-group" id="search-form" style="margin-right: 50px; margin-left: 50px;">
					<input autocomplete="off" autofocus type="search" class="form-control search" name="search" placeholder="Nhập điểm đến...">
					<div class="input-group-prepend">
						<!-- <button class="input-group-text"><i class="fa-solid fa-microphone"></i></span> -->
					</div>
				</div>
				<div class="dropdown-content dropdownSearch " style="margin-right: 100px; margin-left: 70px; width: 390px;">
					<!-- <div class="dropdownSearch"></div> -->
				</div>
			</form>

			<!-- <div class="search-container">
				<form action="/action_page.php">
					<input type="text" placeholder=".." name="search">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div> -->
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
@include('client.layout.script')
<script>
	const searchForm = document.querySelector("#search-form");
	const searchFormInput = searchForm.querySelector("input"); // <=> document.querySelector("#search-form input");
	const info = document.querySelector(".info");

	// The speech recognition interface lives on the browser’s window object
	const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition; // if none exists -> undefined

	if (SpeechRecognition) {
		console.log("Your Browser supports speech Recognition");

		const recognition = new SpeechRecognition();
		recognition.continuous = true;
		// recognition.lang = "en-US";

		searchForm.insertAdjacentHTML("beforeend", '<button type="button" class="input-group-text voice"><i class="fas fa-microphone"></i></button>');
		searchFormInput.style.paddingRight = "50px";

		const micBtn = searchForm.querySelector("button");
		const micIcon = micBtn.firstElementChild;

		micBtn.addEventListener("click", micBtnClick);

		function micBtnClick() {
			if (micIcon.classList.contains("fa-microphone")) { // Start Voice Recognition
				recognition.start(); // First time you have to allow access to mic!
			} else {
				recognition.stop();
			}
		}

		recognition.addEventListener("start", startSpeechRecognition); // <=> recognition.onstart = function() {...}
		function startSpeechRecognition() {
			micIcon.classList.remove("fa-microphone");
			micIcon.classList.add("fa-microphone-slash");
			searchFormInput.focus();
			console.log("Voice activated, SPEAK");
		}

		recognition.addEventListener("end", endSpeechRecognition); // <=> recognition.onend = function() {...}
		function endSpeechRecognition() {
			micIcon.classList.remove("fa-microphone-slash");
			micIcon.classList.add("fa-microphone");
			searchFormInput.focus();
			console.log("Speech recognition service disconnected");
		}

		recognition.addEventListener("result", resultOfSpeechRecognition); // <=> recognition.onresult = function(event) {...} - Fires when you stop talking
		function resultOfSpeechRecognition(event) {
			const current = event.resultIndex;
			const transcript = event.results[current][0].transcript;

			if (transcript.toLowerCase().trim() === "dừng") {
				recognition.stop();
			} else if (!searchFormInput.value) {
				searchFormInput.value = transcript;
			} else {
				if (transcript.toLowerCase().trim() === "go") {
					searchForm.submit();
				} else if (transcript.toLowerCase().trim() === "reset input") {
					searchFormInput.value = "";
				} else {
					searchFormInput.value = transcript;
				}
			}
			// searchFormInput.value = transcript;
			// searchFormInput.focus();
			// setTimeout(() => {
			//   searchForm.submit();
			// }, 500);
		}

		info.textContent = 'Voice Commands: "stop recording", "reset input", "go"';

	} else {
		console.log("Your Browser does not support speech Recognition");
		info.textContent = "Your Browser does not support Speech Recognition";
	}
</script>
<br><br>