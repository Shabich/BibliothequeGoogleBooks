<?php
include_once "../header.php"
?>

<form action="/process_payment" method="post">
<div class="form-group">
<label for="first_name">Prénom:</label>
<input type="text" id="first_name" name="first_name" required>
</div>
<div class="form-group">
<label for="last_name">Nom:</label>
<input type="text" id="last_name" name="last_name" required>
</div>
<div class="form-group">
<label for="email">Email:</label>
<input type="email" id="email" name="email" required>
</div>
<div class="form-group">
<label for="card_number">Numéro de carte bancaire:</label>
<input type="text" id="card_number" name="card_number" required>
</div>
<div class="form-group">
<label for="expiration_date">Date d'expiration:</label>
<input type="text" id="expiration_date" name="expiration_date" required>
</div>
<div class="form-group">
<label for="cvv">CVV:</label>
<input type="text" id="cvv" name="cvv" required>
</div>
<button type="submit">Payer</button>
</form>

<?php
include_once "../footer.php"
?>