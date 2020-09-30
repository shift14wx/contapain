<div class="table-responsive-sm">
    <table class="table table-striped" id="cartoons-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Avalible</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cartoons as $cartoon)
            <tr>
                <td>{{ $cartoon->name }}</td>
            <td>{{ $cartoon->avalible }}</td>
                <td>
                    {!! Form::open(['route' => ['cartoons.destroy', $cartoon->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cartoons.show', [$cartoon->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('cartoons.edit', [$cartoon->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>