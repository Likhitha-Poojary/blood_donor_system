document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const name = document.getElementById("name").value.trim();
    const age = parseInt(document.getElementById("age").value);
    const gender = document.getElementById("gender").value;
    const phone = document.getElementById("phone").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message");
    const ageError = document.getElementById("ageError");

    // Clear previous messages
    message.textContent = "";
    ageError.textContent = "";

    if (name === "" || isNaN(age) || gender === "" || phone === "" || email === "") {
        message.textContent = "Please fill in all fields correctly.";
        message.style.color = "red";
        return;
    }

    if (age < 18 || age > 65) {
        ageError.textContent = "⛔ Age must be between 18 and 65 to donate blood.";
        ageError.style.color = "red";
        return;
    }

    if (!/^[0-9]{10}$/.test(phone)) {
        message.textContent = "Enter a valid 10-digit phone number.";
        message.style.color = "red";
        return;
    }

    if (!/^\S+@\S+\.\S+$/.test(email)) {
        message.textContent = "Enter a valid email address.";
        message.style.color = "red";
        return;
    }

    message.textContent = "✅ Registration successful!";
    message.style.color = "green";

    // Clear form
    this.reset();
});