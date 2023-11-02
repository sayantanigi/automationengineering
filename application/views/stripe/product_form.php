<?php
//print_r($price);die();
require 'vendor/autoload.php';
require_once APPPATH."third_party/stripe/init.php";
\Stripe\Stripe::setApiKey('sk_test_835fqzvcLuirPvH0KqHeQz9K');

$checkout_session = \Stripe\Checkout\Session::create([
    'success_url' => base_url('stripe/payment_success/{CHECKOUT_SESSION_ID}'),
    'cancel_url' => base_url('subscription'),
    'payment_method_types' => ['card'],
    'mode' => 'subscription',
    'line_items' => [['price' => $amount, 'quantity' => 1]],
]);

$session = \Stripe\Checkout\Session::retrieve($checkout_session['id']);
?>
<head>
<title>Stripe Subscription Checkout</title>
<script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<script type="text/javascript">
    var stripe = Stripe('pk_test_kSKjcWbAp63mFILy3vx1mx7Z');
    var session = "<?php echo $checkout_session['id']; ?>";
    stripe.redirectToCheckout({ sessionId: session }).then(function(result) {
    // If `redirectToCheckout` fails due to a browser or network
    // error, you should display the localized error message to your
    // customer using `error.message`.
        //alert(result);
        if (result.error) {
            alert(result.error.message);
        }
    })
    .catch(function(error) {
        console.error('Error:', error);
    });
</script>
</body>
