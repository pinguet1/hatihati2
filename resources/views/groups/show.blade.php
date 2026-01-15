
<h1> {{ $group->users->first()->name }} Welcome to your group</h1>

<h3>{{ $group->name }}</h3>

<section>
    <h2>People in {{$group->name}}</h2>
    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->name ?? $user->email }}
            </li>
        @endforeach
    </ul>

    <details>
        <summary>
            Invite a new member
        </summary>

        <form method="POST" action="/group/{{$group->id}}/people">
            @csrf

            <label for="email">Email</label>
            <input id="email" name="email" type="email"/>

            <button>Invite</button>
        </form>
    </details>

</section>

<section>

    <form action="/expenses/{{$group->id}}" method="POST">
        @csrf
        <details>
            <summary> Add an expense </summary>

            <label for="description">description</label>
            <input id="description" type="text" name="description">

            <label for="amount">amount</label>
            <input id="amount" type="number" name="amount">

            <button>submit</button>
        </details>
    </form>

</section>

