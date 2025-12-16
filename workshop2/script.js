const menuButton = document.getElementById("menu-button");
const navLinks = document.querySelector(".nav-links");

menuButton.addEventListener("click", () => {
    navLinks.classList.toggle("open");

    const isOpen = navLinks.classList.contains("open");
    menuButton.setAttribute("aria-expanded", isOpen);
    menuButton.innerHTML = isOpen ? "✕" : "☰";
});
const contactForm = document.getElementById("contact-form");
const messageDiv = document.getElementById("form-message");

contactForm.addEventListener("submit", function (event) {
    event.preventDefault();

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();

    if (name === "" || email === "") {
        messageDiv.textContent = "Please fill all required fields.";
        messageDiv.style.color = "red";
    } else {
        messageDiv.textContent = "Thank you! Your message has been received.";
        messageDiv.style.color = "green";
        contactForm.reset();
    }
});
