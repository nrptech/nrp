"use strict";

let selectQuantities = document.querySelectorAll('.cantidad');
let inputQuantitiesManual = document.querySelectorAll('.cantidad-manual');
let afterTaxesElements = document.querySelectorAll('.afterTaxes');
let totalPriceElements = document.querySelectorAll('.totalPrice');
let totalCartPrice = 0;

selectQuantities.forEach((selectQuantity, index) => {
    selectQuantity.addEventListener('change', function () {
        let quantity = parseInt(this.value);
        let unitPrice = parseFloat(afterTaxesElements[index].innerHTML);

        let total = unitPrice * quantity;
        let formattedTotal = total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        totalPriceElements[index].innerHTML = formattedTotal;

        if (quantity == 10) {
            this.style.display = 'none';
            inputQuantitiesManual[index].style.display = 'block';
        } else {
            this.style.display = 'block';
            inputQuantitiesManual[index].style.display = 'none';
        }
        if (quantity <= 0) {
            this.parentNode.parentNode.parentNode.parentNode.parentNode.style.display = 'none';
        }
        updateTotalCart()
    });
});


inputQuantitiesManual.forEach((inputQuantityManual, index) => {
    inputQuantityManual.addEventListener('input', function () {
        let quantity = parseInt(this.value);
        let unitPrice = parseFloat(afterTaxesElements[index].innerHTML);

        let total = unitPrice * quantity;
        let formattedTotal = total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        totalPriceElements[index].innerHTML = formattedTotal;

        if (quantity <= 0) {
            this.parentNode.parentNode.parentNode.parentNode.parentNode.style.display = 'none';
        }
        updateTotalCart()
    });
});

function updateTotalCart() {
    totalCartPrice = 0;
    totalPriceElements.forEach(price => {
        totalCartPrice += parseFloat(price.innerHTML.replace(',', ''));
    });
    document.querySelector(".totalCartPrice").innerHTML = totalCartPrice.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}