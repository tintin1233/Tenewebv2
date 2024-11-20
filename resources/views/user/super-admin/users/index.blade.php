@php
    use App\Enums\UserRoles;

    $links = [
        UserRoles::ADMIN->value  => 'super-admin.users.admins.index',
        UserRoles::TENANT->value => 'super-admin.users.tenants.index'
    ]
@endphp


<x-dashboard.super-admin.base>
    <x-dashboard.page-label title="Users" />


    <div class="panel flex flex-col gap-2 p-2">
        <div class="grid grid-cols-2 grid-flow-row  gap-2 h-32 w-full">
            @foreach ($userCounts as $userCount)
                <a href="{{$links[$userCount['name']] ? route($links[$userCount['name']]) : "#"}}" class="w-full rounded-lg shadow-lg p-2 
                capitalize flex flex-col justify-between hover:bg-primary duration-700 hover:text-accent hover:scale-95">
                    <h1 class="font-bold">{{$userCount['name']}}</h1>
                    <h1 class="text-4xl font-bold text-center">{{$userCount['total']}}</h1>
                </a>
            @endforeach
        </div>
    </div>
</x-dashboard.super-admin.base>
