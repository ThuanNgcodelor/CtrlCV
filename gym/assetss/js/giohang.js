  function updateQuantity(input, price) {
        var form = input.closest("form");
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", form.action, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Update the total price after successful update
                var totalPriceElement = document.getElementById("total-price");
                var updatedQuantity = parseInt(input.value);
                var updatedPrice = price * updatedQuantity;
                totalPriceElement.textContent = updatedPrice + " VNĐ";
            }
        };
        xhr.send(formData);
    }