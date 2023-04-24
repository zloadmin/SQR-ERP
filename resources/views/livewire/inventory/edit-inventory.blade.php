<div>
    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-sm-6 col-xl-4">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $inventory->available }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Available</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-4">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-cart text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $inventory->used }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Used</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-4">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-cart text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $inventory->cumulative }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Cumulative</p>
                                </div>
                            </div>
                        </div>


                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('settings.inventory.edit.add-stock', $inventory) }}" class="btn btn-danger mb-2">
                                <i class="mdi mdi-plus-circle mr-2"></i>
                                Add Stock
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
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stocks as $stock)
                                            <tr>
                                                <td class="table-user">
                                                    {{ $stock->id }}
                                                </td>
                                                <td>
                                                    {{ $stock->name }}
                                                </td>
                                                <td>
                                                    {{ $stock->quantity }}
                                                </td>
                                                <td class="table-action">
                                                    @include('livewire.buttons.delete-with-confirm', ['delete_id' => $stock->id])
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
</div>
