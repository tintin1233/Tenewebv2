<div class="w-full flex justify-center bg-white p-2">
    <div class="w-5/6 flex justify-between items-center">
        <div class="flex items-center gap-5">
            <img src="{{ asset('logo.png') }}" class="h-12 w-12 rounded-full" />
            <h1 class="font-bold text-3xl text-neutral">
                Ciudad De Strike
            </h1>
        </div>

        <div class="flex items-center gap-5  text-center">
            <a href="#" class="hover:font-bold hover:scale-105 duration-700 ">Home</a>
            <a href="#" class="hover:font-bold hover:scale-105 duration-700 ">About</a>
            <a href="#" class="hover:font-bold hover:scale-105 duration-700 ">Service</a>
            <a href="#" class="hover:font-bold hover:scale-105 duration-700 ">Units</a>

            @if (!Auth::user())
                <button href="{{ route('login') }}" class="btn btn-accent btn-sm"
                    onclick="my_modal_1.showModal()">Login</a>
                @else
                    <a href="{{ route('home') }}" class="btn btn-accent btn-sm">Dashboard</a>
            @endif

        </div>
    </div>

    <dialog id="my_modal_1" class="modal">
        <div class="modal-box">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold">Welcome to Ciudad De Strike</h3>

                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
            </div>
            <p class="py-4 text-xs">Sign-in your account</p>


            <form action="{{route('login')}}" method="post" class="flex flex-col gap-2">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="">Email</label>
                    <input type="email" name="email" class="input input-sm input-accent" placeholder="Email">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Password</label>
                    <input type="password" name="password" class="input input-sm input-accent" placeholder="Enter Password">
                </div>
                <button class="btn btn-accent">Login</button>
            </form>

        </div>
    </dialog>
</div>
