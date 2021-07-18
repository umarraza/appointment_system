<table class="table table-bordered">
    <thead>                  
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Specialisation</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doctors as $doctor)
        <tr>
            <td>
                <a href="{{ route('doctor.show', $doctor->id) }}">{{ $doctor->first_name. ' ' .$doctor->last_name }}</a>
            </td>
            <td>{{ $doctor->email }}</td>
            <td>{{ $doctor->specialisation }}</td>
        </tr>
        @endforeach
    </tbody>
</table>