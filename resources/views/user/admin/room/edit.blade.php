<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('admin.rooms.index')" title="Edit Unit" />

    <div class="panel p-2">
        <form action="{{ route('admin.rooms.update', ['room' => $room->id]) }}" method="post"
        class="w-full h-full flex flex-col gap-2">
        @csrf
        @method('put')
        <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">Room Number</h1>
            <input type="text" name="room_number" class="input-generic" value="{{$room->room_number}}">
        </div>

        @if ($errors->has('room_number'))
            <p class="text-xs text-error">{{ $errors->first('room_number') }}</p>
        @endif


        <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">Description</h1>
            <x-quill-editor >
                {!! $room->description !!}
            </x-quill-editor>
        </div>

      
        
        @if ($errors->has('descriptions'))
            <p class="text-xs text-error">{{ $errors->first('descriptions') }}</p>
        @endif

       
        <button class="btn btn-sm btn-primary text-accent">Submit</button>
    </form>
    </div>
</x-dashboard.admin.base>
