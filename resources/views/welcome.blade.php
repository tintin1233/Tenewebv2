<x-landing-page.base>
    <div class="h-full w-full flex justify-between">
        <div class="w-1/2">
            <div class="w-full h-[35rem] relative mb-10">
                <div class="swiper mySwiper" >
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{asset('images/IMG_20241030_164441 (1).jpg')}}" alt="" srcset="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('images/2.jpg')}}" alt="" srcset="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('images/3.jpg')}}" alt="" srcset="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('images/4.jpg')}}" alt="" srcset="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('images/5.jpg')}}" alt="" srcset="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('images/6.jpg')}}" alt="" srcset="">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{asset('images/7.jpg')}}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <div class="grow flex flex-col justify-center items-center">
            <div class="w-5/6 flex flex-col gap-2">
                <h1 class="font-bold text-4xl capitalize">Welcome to CIUDAD De Strike HOAI</h1>
                <p class="whitespace-pre-line text-xs">CIUDAD De Strike is a community that values safety, quality of
                    life, and trust.
                    Our neighborhood is designed to provide a comfortable and safe place for you and
                    your family to live, work, and play.</p>
                <a href="{{ route('pre.register.create') }}" class="btn btn-accent">Register</a>
            </div>
        </div>
    </div>

<section class="text-gray-600 body-font">
  <div class="container px-4 py-12 mx-auto">
    <div class="flex flex-col text-center w-full mb-8">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900" style="font-size:2.5vh; font-weight:bold;">Units Preview</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">View</p>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4">
      <div class="p-2">
        <div class="flex relative" style="height:50vh;">
          <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{asset('images/u1.jpg')}}">
          <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">THE SUBTITLE</h2>
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Shooting Stars</h1>
            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
          </div>
        </div>
      </div>
      <div class="p-2">
        <div class="flex relative" style="height:50vh;">
          <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{asset('images/u2.jpg')}}">
          <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">THE SUBTITLE</h2>
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The Catalyzer</h1>
            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
          </div>
        </div>
      </div>
      <div class="p-2">
        <div class="flex relative" style="height:50vh;">
          <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{asset('images/3.jpg')}}">
          <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">THE SUBTITLE</h2>
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">The 400 Blows</h1>
            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
          </div>
        </div>
      </div>
      <div class="p-2">
        <div class="flex relative" style="height:50vh;">
          <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{asset('images/u4.jpg')}}">
          <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">THE SUBTITLE</h2>
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Neptune</h1>
            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
          </div>
        </div>
      </div>
      <div class="p-2">
        <div class="flex relative" style="height:50vh;">
          <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{asset('images/u5.jpg')}}">
          <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">THE SUBTITLE</h2>
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Holden Caulfield</h1>
            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
          </div>
        </div>
      </div>
      <div class="p-2">
        <div class="flex relative" style="height:50vh;">
          <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{asset('images/u6.jpg')}}">
          <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">THE SUBTITLE</h2>
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Alper Kamu</h1>
            <p class="leading-relaxed">Photo booth fam kinfolk cold-pressed sriracha leggings jianbing microdosing tousled waistcoat.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</x-landing-page.base>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!--
<script>
  var swiper = new Swiper('.mySwiper', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  });
</script>
-->

<script>
  var swiper = new Swiper('.mySwiper', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
</script>