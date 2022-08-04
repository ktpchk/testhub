window.form.addEventListener("submit", async function (e) {
    e.preventDefault();
    this.querySelectorAll(".errorDiv").forEach((div) => div.remove());

    let formData = new FormData(this);
    let response = await fetch("/tests/store", {
        method: "POST",
        body: formData,
    });
    let result = await response.json();

    for (let key in result) {
        let error = result[key];
        if (!this.elements[key]) key += "[]";
        let element = this.elements[key];

        let errorDiv = document.createElement("div");
        errorDiv.className = "text-red-500 text-xs mt-1 errorDiv";
        errorDiv.textContent = error;
        if (!element.length) {
            element.closest(".errorContainer").append(errorDiv);
        } else {
            element[0].closest(".errorContainer").append(errorDiv);
        }

        if (element.type == "text" || element.type == "textarea") {
            this.elements[key].addEventListener("input", removeErrorDiv);
        } else {
            this.elements[key].addEventListener("change", removeErrorDiv);
        }

        function removeErrorDiv(e) {
            let errorDiv = Array.from(
                e.currentTarget.closest(".errorContainer").children
            )
                .find((item) => item.classList.contains("errorDiv"))
                ?.remove();
        }
    }
});
