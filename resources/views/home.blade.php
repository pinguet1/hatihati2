<h1>BAYAD-BAYAD</h1>

<p>
    <a href="/groups/create">Add New Group</a>
</p>

@foreach($groups as $group)
    <li>
        <a href="group/{{ $group -> id }}">{{$group->name}}</a>
    </li>
@endforeach
