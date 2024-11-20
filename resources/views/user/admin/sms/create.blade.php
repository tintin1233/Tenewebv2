<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('admin.rooms.index')" title="SMS" />

    <div class="panel p-2">
        <form action="{{ route('admin.sms.send') }}" method="post" class="w-full h-full flex flex-col gap-2" x-data="{
        sendType : 'all'
        }">
            @csrf
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Send Type</h1>

                <select name="send_type" @change="($event) => {sendType = $event.target.value}" class="select select-primary w-full select-sm text-sm">
                    <option disabled selected>Select Sent Type</option>

                    <option value="all">All</option>
                    <option value="specific">Specific</option>

                </select>
                @if ($errors->has('room'))
                    <p class="text-xs text-error">{{ $errors->first('room') }}</p>
                @endif
            </div>

            <div class="flex flex-col gap-2" x-show="sendType === 'specific'">
                <h1 class="input-generic-label">Mobile Number</h1>
                <input type="text" name="mobile_number" class="input-generic" value="+63">
            </div>

            @if ($errors->has('room_number'))
                <p class="text-xs text-error">{{ $errors->first('mobile_number') }}</p>
            @endif


            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Description</h1>
                <textarea name="message" class="textarea h-32 w-full textarea-accent"></textarea>
            </div>



            @if ($errors->has('message'))
                <p class="text-xs text-error">{{ $errors->first('message') }}</p>
            @endif

            {{-- <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">Price</h1>
            <input type="number" name="price" class="input-generic">
        </div>

        @if ($errors->has('price'))
            <p class="text-xs text-error">{{ $errors->first('price') }}</p>
        @endif
        --}}

            <button class="btn btn-sm btn-primary text-accent">Send</button>
        </form>
    </div>
</x-dashboard.admin.base>
