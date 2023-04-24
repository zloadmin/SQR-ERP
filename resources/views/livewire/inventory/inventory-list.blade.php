<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <a href="{{ route('settings.inventory.create') }}" class="btn btn-danger mb-2">
                            <i class="mdi mdi-plus-circle mr-2"></i>
                            Create
                        </a>
                    </div>
                    <div class="col-sm-8">
                    </div><!-- end col-->
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-centered mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Used</th>
                                    <th>Available</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($inventories as $inventory)
                                    <tr>
                                        <td class="table-user">
                                            {{ $inventory->id }}
                                        </td>
                                        <td>
                                            {{ $inventory->name }}
                                        </td>
                                        <td>
                                            {{ $inventory->stocks()->sum('quantity') }}
                                        </td>
                                        <td>
                                            {{ $inventory->used }}
                                        </td>
                                        <td>
                                            {{ $inventory->stocks()->sum('quantity') - $inventory->used  }}
                                        </td>
                                        <td class="table-action">
                                            <a href="{{ route('settings.inventory.edit', $inventory) }}" class="btn btn-link action-icon"> <i class="mdi mdi-pencil"></i></a>
                                            @include('livewire.buttons.delete-with-confirm', ['delete_id' => $inventory->id])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
