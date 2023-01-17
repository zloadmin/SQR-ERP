<div class="card">
    <div class="card-body">
        <div class="row justify-content-between mb-2">
            <div class="col-sm-4">
                <a href="{{ route('settings.tag.create') }}" class="btn btn-danger mb-2">
                    <i class="mdi mdi-plus-circle mr-2"></i> New Tag
                </a>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped table-centered mb-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Color</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    @if ($tag->color)
                                        <div disabled class="btn btn-primary" style="width: 200px; background-color: {{ $tag->color }}; border-color: {{ $tag->color }};"> {{ $tag->color }}</div>
                                    @endif
                                </td>
                                <td align="right">
                                    <a href="{{ $tag->getEditLink() }}" class="action-icon  btn btn-link">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    @include('livewire.buttons.delete-with-confirm', ['delete_id' => $tag->id])
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-auto">
                {{ $tags->links() }}
            </div>
        </div>
    </div>
</div>

