window.form.addEventListener("submit", async function (e) {
    e.preventDefault();
    this.querySelectorAll(".errorDiv").forEach((div) => div.remove());

    let formData = new FormData(this);
    let response = await fetch("/tests/store", {
        method: "POST",
        body: formData,
    });
    console.log(response);
    if (response.ok) {
        let result = await response.json();
        console.log(result);
    } else if (response.status == 422) {
        let result = await response.json();

        for (let key in result) {
            let error = result[key];
            if (!this.elements[key]) key += "[]";
            let element = this.elements[key];
            if (element.length) element = element[0];

            let errorDiv = document.createElement("div");
            errorDiv.className = "text-red-500 text-xs mt-1 errorDiv";
            errorDiv.textContent = error;

            element.closest(".errorContainer").append(errorDiv);

            let event =
                element.type == "text" || element.type == "textarea"
                    ? "input"
                    : "change";

            console.log(result);
            console.log(key, error, element);
            element.addEventListener(event, removeErrorDiv);

            function removeErrorDiv(e) {
                let errorDiv = Array.from(
                    e.currentTarget.closest(".errorContainer").children
                )
                    .find((item) => item.classList.contains("errorDiv"))
                    ?.remove();
            }
        }
    } else if (response.status == 500) {
        let result = await response.text();
        console.log(result);
    }
});
