let summaryItem = document.getElementById("symmary-item");

function updateSummary() {
  let total = 0;
  summaryItem.innerHTML = "";

  let items = document.querySelectorAll(".payment-card");

  items.forEach((card) => {
    let checkbox = card.children[3].children[2];
    if (checkbox.checked) {
      let className = [
        card.children[0].children[1].children[0].innerText,
        card.children[0].children[1].children[1].innerText,
      ];

      let priceText = card.children[2].innerText;
      let price = parseFloat(priceText.replace(/[^0-9.-]+/g, "")) || 0;
      total += price;

      summaryItem.innerHTML += `
        <div class="summary-line">
          <div class="text-block">
            <div class="item-title">${className[0]}</div>
            <div class="item-subtitle">${className[1]}</div>
          </div>
          <div class="item-price">${priceText}</div>
        </div>
      `;
    }
  });

  summaryItem.innerHTML += `
    <hr>
    <div class="summary-total">
      <span class="item-price">$${total.toFixed(2)}</span>
    </div>
    <button class="pay-all-btn">Pay All</button>
  `;
}

document.addEventListener("DOMContentLoaded", () => {
  updateSummary();

  document
    .querySelectorAll(".payment-card input[type='checkbox']")
    .forEach((checkbox) => {
      checkbox.addEventListener("change", updateSummary);
    });
});
