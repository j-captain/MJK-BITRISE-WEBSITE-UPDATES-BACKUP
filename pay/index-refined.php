<?php include('top.php'); ?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        
    }

    .payment-form-wrapper {
        max-width: 600px;
        margin: auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .payment-form-wrapper h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #2A4050;
    }

    form table {
        width: 100%;
    }

    form td {
        padding: 10px 5px;
        vertical-align: top;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-top: 5px;
    }

    input[type="submit"] {
        background-color: #E74C3C;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #2A4050;
    }

    .checkbox-group {
        margin-top: 15px;
        background: #f1f9ff;
        border-left: 4px solid #1e90ff;
        padding: 12px;
        border-radius: 6px;
        font-size: 14px;
    }

    .checkbox-group input[type="checkbox"] {
        margin-right: 8px;
    }

    #refholder {
        display: none;
    }

    .info-note {
        font-size: 13px;
        color: #666;
        margin-top: 5px;
    }

    @media (max-width: 600px) {
        .payment-form-wrapper {
            padding: 20px;
        }
    }
</style>

<script>
    function referenceShuffle() {
        const checkbox = document.getElementById('ref');
        const refHolder = document.getElementById("refholder");
        refHolder.style.display = checkbox.checked ? "block" : "none";
    }
</script>

<head>
    <link rel="icon" type="image/x-icon" href="../img/icon.png">
</head>
<div class="payment-form-wrapper">
    <h2>Bitrise - Secure Payment Form</h2>
    <form action="iframe.php" method="post">
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="first_name" required /></td>
            </tr>
            <!--<tr>-->
            <!--    <td>Last Name</td>-->
            <!--    <td><input type="text" name="last_name" required /></td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--    <td>Email Address</td>-->
            <!--    <td><input type="email" name="email" required /></td>-->
            <!--</tr>-->
            <tr>
                <td>Phone Number</td>
                <td><input type="tel" name="phone_number" required /></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>
                    <select name="currency" id="currency" required>
                        <option value="KES">KES</option>
                        <!--<option value="UGX">UGX</option>-->
                        <!--<option value="TZS">TZS</option>-->
                        <!--<option value="USD">USD</option>-->
                    </select>
                    <input type="text" name="amount" placeholder="Enter amount" required />
                </td>
            </tr>
            <tr id="refholder">
                <td>Reference Code</td>
                <td><input type="text" name="reference" placeholder="Client's unique code" /></td>
            </tr>
            <tr>
             
            </tr>
           
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" value="Payment to Bitrise Solutions Company" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Make Payment" />
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include('bottom.php'); ?>
