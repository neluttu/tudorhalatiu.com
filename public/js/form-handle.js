document.addEventListener('DOMContentLoaded', function() {

    var accountCreateCheckbox = document.getElementById("account-create");
    var passwdSection = document.getElementById("passwd");
    var passwdTip = document.getElementById("passwordTip");

    if(accountCreateCheckbox)
        accountCreateCheckbox.addEventListener('change', function() {
            if (accountCreateCheckbox.checked) {
                passwdSection.classList.add("inline-block");
                passwdSection.classList.remove("hidden");
                passwdTip.classList.add("inline-block");
                passwdTip.classList.remove("hidden");
            } else {
                passwdSection.classList.remove("inline-block");
                passwdSection.classList.add("hidden");
                passwdTip.classList.remove("inline-block");
                passwdTip.classList.add("hidden");
            }
        });

    const deliveryCheckbox = document.getElementById("delivery");
                        const deliveryInfo = document.getElementById("delivery-info");
                        deliveryCheckbox.addEventListener('change', function() {
                            if (deliveryCheckbox.checked) {
                                deliveryInfo.style.maxHeight = deliveryInfo.scrollHeight + "px";
                            } else {
                                deliveryInfo.style.maxHeight = 0;
                            }
    });

    const hiddenInput = document.getElementById('payment');
    const paymentRadios = document.querySelectorAll('input[name="payment"]');
    paymentRadios.forEach(radio => { radio.addEventListener('change', () => { if (radio.checked) hiddenInput.value = radio.value; }); });

    const terms = document.getElementById('terms');
    const privacy = document.getElementById('privacy');
    const submitBtn = document.getElementById('submitBtn');

    terms.addEventListener('change', updateSubmitButtonState);
    privacy.addEventListener('change', updateSubmitButtonState);

    function updateSubmitButtonState() {
        if (terms.checked && privacy.checked) {
            submitBtn.removeAttribute('disabled');
            submitBtn.innerText = 'Înregistrează și plătește comanda';
        } else {
            submitBtn.setAttribute('disabled', 'disabled');
            submitBtn.innerText = 'Acceptă condițiile de mai sus mai întâi';
        }
    }

});
