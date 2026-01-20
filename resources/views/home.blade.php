<h1>BAYAD-BAYAD</h1>

<p>
    <a href="/groups/create">Add New Group</a>
</p>

@foreach($groups as $group)
    <li>
        <a href="group/{{ $group -> id }}">{{$group->name}}</a>
    </li>
@endforeach

<section>
    <h3>You have to pay up..</h3>

    <li>
        @foreach($payments as $payment)
            <p>
                {{$payment->expense->description}}  {{$payment->split_amount}}
            </p>
        @endforeach
    </li>

</section>
