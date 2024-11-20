<x-dashboard.admin.base>

    <div class="min-h-screen w-full">
        <div class="panel p-2">

            <x-table-body :columns="['name', 'Unit No.', 'Move in Date', 'Move Out']" :hideAction="true" label="Previous Tenants - Archive" >

                @forelse ($tenants as $tenant)
                    <tr>
                        <td>

                        </td>
                        <td>
                            {{ $tenant->name }}
                        </td>
                        <td>
                            {{ $tenant->tenant->room->room_number }}
                        </td>
                        <td>
                            {{ date('F d, Y', strtotime($tenant->tenant->move_in_date)) }}
                        </td>
                        <td>
                            {{ date('F d, Y', strtotime($tenant->tenant->move_out_date)) }}
                        </td>


                        <td class="flex gap-2 justify-center">
                            {{-- <a href="{{route('admin.tenants.show', ['tenant' => $tenant->id])}}" class="btn btn-accent btn-sm text-primary">
                                <i class="fi fi-rr-eye"></i>
                            </a> --}}
                            {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                                <i class="fi fi-rr-edit"></i>
                            </a> --}}
                            {{-- <form action="{{route('admin.tenants.destroy', ['tenant' => $tenant->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-error btn-sm">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <td>No Tenant</td>
                @endforelse
                <tr>
                    <td></td>
                </tr>
            </x-table-body>
        </div>
    </div>
</x-dashboard.admin.base>
