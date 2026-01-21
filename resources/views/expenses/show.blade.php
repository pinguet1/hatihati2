
    <h3>{{ $expense->description }} {{ $expense->amount }} added by {{$expense->user->name}}</h3>


<section>
    <p> Who's sharing the expense? </p>
    <div>
        <form action="{{$expense->id}}/payments/split" method="POST">
            @csrf
            @foreach($expense->group->users as $user)
                <label>
                    <input type="checkbox" name="users[]" value="{{$user->id}}">

                    {{$user->name}}
                </label>
            @endforeach
            <button>Split</button>
        </form>
    </div>
</section>
d
