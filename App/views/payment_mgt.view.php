<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Class Payment Status</title>
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/payment_mgt.css" />
  </head>
  <body>
    <div class="payment-container">
      <div class="payment-header">
        <div>Class Name</div>
        <div>Last Payment Date</div>
        <div>Price</div>
        <div>Payment Status</div>
      </div>
      
      <?php  foreach (range(1, 5) as $i): ?>

      <div class="payment-card" id="payment-card">
        <div class="card-left">
          <div class="thumb"></div>
          <div class="class-info">
            <h4>Information System</h4>
            <p>Revolutionizing the Future</p>
          </div>
        </div>

        <div class="card-mid">
          <span class="month">July :</span>
          <p class="date">2025/07/15</p>
        </div>

        <div class="card-price">
          <p>$50</p>
        </div>

        <div class="card-right">
          <span class="status">August :</span>
          <button class="pay-btn">Pay Now</button>
          <input type="checkbox" id="class-check">
        </div>
      </div>
      <?php endforeach; ?>
      
      <div class="payment-summary">
        <div class="summary-item" id="symmary-item">
        </div>
      </div>
    </div>
    <script src="<?php  echo ROOT ?>/assets/js/payment_mgt.js" ></script>
  </body>
</html>
