@extends('layouts.app')
@section('css')

<style>
	.StripeElement, #card-holder-name{
  box-sizing: border-box;

  height: 40px;
  width: 400px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
#card-button{
  background-color: teal; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}

</style>

@endsection

@section('content')
		

	<form action="{{route('subscription.store')}}" id="signup-form" method="POST">

		@csrf
				
		<p id="error"></p>
		<div class="container">
			
		<input id="card-holder-name" type="text">

		<span id="card-errors"></span>

		<br>
		<br>
		
		<!-- Stripe Elements Placeholder -->
		<div id="card-element"></div>
		
		<br>
		<button id="card-button">
	    Process Payment
		</button>

	</form>



</div>
@endsection

@section('js')
	<script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env("STRIPE_KEY") }}');
        // console.log(stripe);

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        let validCard = false;
        const cardError = document.getElementById('card-errors');

        cardElement.addEventListener('change', function(event) {
            
            if (event.error) {
                validCard = false;
                cardError.textContent = event.error.message;
            } else {
                validCard = true;
                cardError.textContent = '';
            }
        });

        var form = document.getElementById('signup-form');

        form.addEventListener('submit', async (e) => {
            event.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: { name: cardHolderName.value }
                }
            );

            if (error) {
                // Display "error.message" to the user...
                document.getElementById('error').textContent = error.message;

                // console.log(error);
            } else {
                // The card has been verified successfully...
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', paymentMethod.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }

        });
	</script>

@endsection