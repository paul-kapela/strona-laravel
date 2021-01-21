<tr>
  <th>
    <a href="{{ route('users.show', $user) }}"><h4 class="mr-4">{{ $user->username }}</h4></a>
  </th>

  <th>
    <h6>{{ $user->rolesToString() }}</h6>
  </th>

  <th>
    <h6>{{ $user->email }}</h6>
  </th>
</tr>