<div class="card">
    <div class="card-body">
        <form wire:submit.prevent="editUserRole" id="editUserRoleForm">
            <table class="table table-striped table-centered mb-0">
                <thead>
                <tr>
                    <th></th>
                    @foreach(\App\Models\Module::LIST as $module)
                        <th>{{ $module['name'] }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Stage::LIST as $stage)
                    <tr>
                        <td class="table-user">
                            {{ $stage['name'] }}
                        </td>
                        @foreach(\App\Models\Module::LIST as $module)
                            <th>
                                @foreach(\App\Models\UserRole::FIELD_TYPES as $type)
                                    @php
                                        $key = \App\Models\UserRole::getAccessFieldKey($stage, $module, $type);
                                        $value = $access_fields[$key];
                                    @endphp
                                    <input type="checkbox" wire:change="editUserRole" wire:model="access_fields.{{ $key }}" id="{{ $key }}" data-switch="primary" />
                                    <label for="{{ $key }}" data-on-label="{{ $type }}" data-off-label="{{ $type }}"></label>
                                @endforeach
                            </th>

                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
