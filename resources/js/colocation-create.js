export function initColocationCreate() {
    console.log("Colocation creation script initialized");
    const colocationImage = document.getElementById("colocation_image");
    const colocationForm = document.getElementById("colocation-form");

    if (colocationImage) {
        colocationImage.addEventListener("change", function (e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            const previewContainer = document.getElementById(
                "image-preview-container",
            );
            const previewImage = document.getElementById("image-preview");
            const placeholder = document.getElementById("upload-placeholder");

            if (file) {
                reader.onload = function (e) {
                    if (previewImage) previewImage.src = e.target.result;
                    if (previewContainer)
                        previewContainer.classList.remove("hidden");
                    if (placeholder) placeholder.classList.add("hidden");
                };
                reader.readAsDataURL(file);
            } else {
                if (previewImage) previewImage.src = "#";
                if (previewContainer) previewContainer.classList.add("hidden");
                if (placeholder) placeholder.classList.remove("hidden");
            }
        });
    }

    if (colocationForm) {
        colocationForm.addEventListener("submit", function (e) {
            let isValid = true;
            const requiredFields = ["name", "address", "city"];

            requiredFields.forEach((fieldId) => {
                const field = document.getElementById(fieldId);
                if (field) {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add(
                            "border-red-500",
                            "ring-1",
                            "ring-red-500",
                        );
                    } else {
                        field.classList.remove(
                            "border-red-500",
                            "ring-1",
                            "ring-red-500",
                        );
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", initColocationCreate);
