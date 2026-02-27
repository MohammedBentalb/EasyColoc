document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("colocation-form");
    const imageInput = document.getElementById("cover_image");
    const imagePreviewContainer = document.getElementById(
        "image-preview-container",
    );
    const imagePreview = document.getElementById("image-preview");
    const uploadPlaceholder = document.getElementById("upload-placeholder");

    if (!form) return;

    // --- Image Preview Logic ---
    imageInput.addEventListener("change", (e) => {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                imagePreview.src = event.target.result;
                imagePreviewContainer.classList.remove("hidden");
                uploadPlaceholder.classList.add("opacity-0");
            };
            reader.readAsDataURL(file);
        } else {
            // If user cancels selection, remove preview
            imagePreview.src = "#";
            imagePreviewContainer.classList.add("hidden");
            uploadPlaceholder.classList.remove("opacity-0");
        }
    });

    // --- Validation Logic ---
    form.addEventListener("submit", (e) => {
        let isValid = true;
        const requiredFields = ["name", "address", "city"];

        requiredFields.forEach((fieldId) => {
            const input = document.getElementById(fieldId);
            const parent = input.closest(".grid");

            // Remove previous error messages
            const existingError = parent.querySelector(".error-message");
            if (existingError) existingError.remove();
            input.classList.remove("border-red-500");

            if (!input.value.trim()) {
                isValid = false;
                input.classList.add("border-red-500");

                const errorMessage = document.createElement("p");
                errorMessage.className =
                    "error-message text-xs text-red-500 mt-1";
                errorMessage.textContent = `Please enter the ${fieldId}.`;
                parent.appendChild(errorMessage);
            }
        });

        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            const firstError = document.querySelector(".border-red-500");
            if (firstError)
                firstError.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                });
        }
    });

    // Handle input events to clear errors dynamically
    ["name", "address", "city"].forEach((fieldId) => {
        const input = document.getElementById(fieldId);
        input.addEventListener("input", () => {
            if (input.value.trim()) {
                input.classList.remove("border-red-500");
                const errorMessage = input
                    .closest(".grid")
                    .querySelector(".error-message");
                if (errorMessage) errorMessage.remove();
            }
        });
    });
});
