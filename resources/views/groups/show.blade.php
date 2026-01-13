
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
</section>

<form action="/expenses" method="POST">
    @csrf
    <div>
        <p> Add an expense </p>

        <p>description</p>

        <input id="description" type="text" name="description">

        <p>amount</p>

        <input id="amount" type="number" name="amount">

        <button>submit</button>
    </div>

</form>
