<div class="card">
    <div class="card-body">
        <div class="table-responsive mb-3">
            <table class="table table-striped table-centered mb-0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Email Alert</th>
                    <th>Recipient</th>
                    <th>Subject</th>
                    <th>Text</th>
                </tr>
                </thead>
                <tbody>
                @foreach($emails as $email)
                    <tr>
                        <td>{{ $email->id }}</td>
                        <td>{{ $email->alert->name }}</td>
                        <td>{{ $email->recipient }}</td>
                        <td>{{ $email->subject }}</td>
                        <td>{{ $email->text }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row justify-content-end">
            <div class="col-auto">
                {{ $emails->links() }}
            </div>
        </div>
    </div>
</div>
