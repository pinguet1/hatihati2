<h1> Let's bayad the bayad </h1>

    <h3>
        {{ $payment->expense->description }}
        {{ $payment->split_amount }}

    </h3>

<div>
    <form action="payments/{payment}/mark-as-paid"
          method="POST"
          enctype="multipart/form-data">

        <input type="file" name="proof_of_payment">

    </form>
</div>
