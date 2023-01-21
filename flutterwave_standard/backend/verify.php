<?php

// Install with: composer require flutterwavedev/flutterwave-v3

function verifyTransaction($data)
{
    // $data = [
    //     "transactionId" => $transactionId,
    //     "amount" => $amount,
    //     "currency" => $currency // Mine is NGN
    // ];

    $flw = new \Flutterwave\Rave(FLUTTERWAVE_SECRET_KEY); // Set `PUBLIC_KEY` as an environment variable
    $transactions = new \Flutterwave\Transactions();
    $response = $transactions->verifyTransaction(['id' => $data['transactionId']]);
    if (
        $response['data']['status'] === "successful"
        && $response['data']['amount'] === $data['amount']
        && $response['data']['currency'] === $data['currency']
    ) {
        // Success! Confirm the customer's payment
    } else {
        // Inform the customer their payment was unsuccessful
    }
}
