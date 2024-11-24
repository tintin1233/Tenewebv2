<style>
@media (max-width: 768px) {
    .text-3xl {
        font-size:2vh !important;
    }
    .input-generic-label{
        font-size:1.5vh !important;
    }
}
</style>
<x-dashboard.super-admin.base>

    <x-notification-message />

    <x-dashboard.page-label :back_url="route('super-admin.users.admins.index')" title="Admins Edit" />


    <div class="panel flex flex-col gap-2 p-2">

        <form action="{{ route('super-admin.users.admins.update', ['admin' => $admin->id]) }}" method="post"
            class="w-full h-full flex flex-col gap-2">
            @method('put')
            @csrf
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Name</h1>
                <input type="text" name="name" class="input-generic" placeholder="{{$admin->name}}">
            </div>

            @if ($errors->has('name'))
                <p class="text-xs text-error">{{ $errors->first('name') }}</p>
            @endif
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Email</h1>
                <input type="email" name="email" class="input-generic" placeholder="{{$admin->email}}">
            </div>
            @if ($errors->has('email'))
                <p class="text-xs text-error">{{ $errors->first('email') }}</p>
            @endif
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Password</h1>
                <input type="password" name="password" class="input-generic">
            </div>
            @if ($errors->has('password'))
                <p class="text-xs text-error">{{ $errors->first('password') }}</p>
            @endif
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Confirm Password</h1>
                <input type="password" name="password_confirmation" class="input-generic">
            </div>
            {{-- <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Tenement</h1>
                <select name="tenement" class="select select-primary w-full select-sm text-sm">
                    <option disabled selected>Select</option>
                    @foreach ($tenements as $tenement)
                        <option value="{{ $tenement->id }}">{{ $tenement->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('tenement'))
                    <p class="text-xs text-error">{{ $errors->first('tenement') }}</p>
                @endif
            </div> --}}

            <button class="btn btn-sm btn-primary text-accent">Submit</button>
        </form>

    </div>
</x-dashboard.super-admin.base>
