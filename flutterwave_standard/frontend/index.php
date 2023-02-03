<?php
require('../backend/index.php');

if (isset($_POST['make_payment_btn'])) {
    if (
        isset($_POST['email'])
        && isset($_POST['first_name']) && isset($_POST['last_name'])
        && isset($_POST['phone']) && isset($_POST['amount'])
    ) {
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $amount = $_POST['amount'];

        $data = [
            "tx_ref" => "123345fiifflsow" . rand(5, 999999),
            "amount" => $amount,
            "currency" => "NGN", // mine is NGN 
            "redirect_url" => REDIRECT_URL,
            "customer" => [
                "name" => $first_name . ' ' . $last_name,
                "email" => $email,
                "phonenumber" => $phone,
                "meta" => ["consumer_id"=> 23, "consumer_mac"=> "92a3-912ba-1192a"], // NOT COMPULSORY
                "customizations" => [
                    "title" => "Pay for apiKodes courses", // YOU CAN EDIT THIS TOO 
                    "logo" => "", // COMPANY LOGO GOES HERE 
                    "description" => "This is my payment tutorial" // A LITTLE DESCRIPTION OF THE PAYMENT 
                ]
            ]
        ];
        
        $make_payment_fn = make_payment($data);

        // {"status":"success","message":"Hosted Link",
            // "data":{"link":"https://ravemodal-dev.herokuapp.com/v3/hosted/pay/3b022174692dac55bf33"}}

        $decode_make_payment_fn = json_decode($make_payment_fn);

        if ($decode_make_payment_fn->status === "success") {
            $create_customer_success_message = $decode_make_payment_fn->message;
            $redirect_url = $decode_make_payment_fn->data->link;

            header('Location: ' . $redirect_url);
        }

        // $create_customer_error_message = "";
        if ($decode_make_payment_fn->status === "error") {
            $create_customer_error_message = $decode_make_payment_fn->message;
        }
    }
}


?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="styles.css" type="text/css" rel="stylesheet" />
    <title>Flutterwave Standard CakePHP Implementation</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 col-md-12 col-lg-12 my-3">
                <h2 class="my-3 text-center">ApiKodes Flutterwave API implementations (Standard Payment)</h2>

                <div class="">
                    <?php
                    if (isset($create_customer_success_message)) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $create_customer_success_message ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    } else {
                    ?>

                        <?php
                        if (isset($create_customer_error_message)) {
                        ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <?= $create_customer_error_message ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <form method="POST" action="" class="px-3">
                        <div class="form-group my-2">
                            <label for="email">Email Address</label>
                            <input name="email" class="form-control form-input" placeholder="Enter email address" type="email" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="first_name">First Name</label>
                            <input name="first_name" class="form-control form-input" placeholder="Enter first name" type="text" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="last_name">Last Name</label>
                            <input name="last_name" class="form-control form-input" placeholder="Enter last name" type="text" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="phone">Phone Number</label>
                            <input name="phone" class="form-control form-input" placeholder="Enter phone number" type="tel" required />
                        </div>
                        <div class="form-group my-2">
                            <label for="amount">Amount</label>
                            <input name="amount" class="form-control form-input" placeholder="Enter amount " type="number" required />
                        </div>
                        <div class="form-submit">
                            <button class="btn btn-primary" name="make_payment_btn" type="submit"> Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
