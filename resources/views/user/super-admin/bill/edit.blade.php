<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label title="Bills Edit" />

    <div class="panel p-2">
        <form action="{{ route('admin.bills.update', ['bill' => $bill->id]) }}" method="post"
        class="w-full h-full flex flex-col gap-2">
        @csrf
        @method('put')
        <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">name</h1>
            <input type="text" name="name" class="input-generic" placeholder="{{$bill->name}}">
        </div>

        @if ($errors->has('name'))
            <p class="text-xs text-error">{{ $errors->first('name') }}</p>
        @endif

        <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">Amount</h1>
            <input type="number" name="amount" class="input-generic" placeholder="{{$bill->amount}}">
        </div>
        @if ($errors->has('amount'))
            <p class="text-xs text-error">{{ $errors->first('amount') }}</p>
        @endif
        <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">Type :  {{$bill->type}}</h1>
            <select name="type" class="select select-primary w-full select-sm text-sm">
                <option disabled selected>Select</option>
                <option value="montly dues">Monthly Dues</option>
                <option value="water">Water</option>
                <option value="electric">Electric</option>
            </select>
            @if ($errors->has('type'))
                <p class="text-xs text-error">{{ $errors->first('type') }}</p>
            @endif
        </div>

        <button class="btn btn-sm btn-primary text-accent">Submit</button>
    </form>
    </div>
</x-dashboard.admin.base>
