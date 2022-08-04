window.form.addEventListener("submit", async function (e) {
    e.preventDefault();
    this.querySelectorAll(".errorDiv").forEach((div) => div.remove());

    let formData = new FormData(this);
    let response = await fetch("/tests/store", {
        method: "POST",
        body: formData,
    });
    let result = await response.json();

    console.log(result);
    for (let key in result) {
        let error = result[key];
        if (!this.elements[key]) key += "[]";
        console.log(
            key,
            error,
            this.elements[key],
            this.elements[key].parentNode
        );

        let errorDiv = document.createElement("div");
        errorDiv.className = "text-red-500 text-xs mt-1 errorDiv";
        errorDiv.textContent = error;
        if (!this.elements[key].length) {
            this.elements[key].closest(".errorContainer").append(errorDiv);
        } else {
            this.elements[key][0].closest(".errorContainer").append(errorDiv);
        }
    }
});
