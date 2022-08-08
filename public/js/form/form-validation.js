window.form.addEventListener("submit", async function (e) {
    e.preventDefault();
    this.querySelectorAll(".errorDiv").forEach((div) => div.remove());

    let formData = new FormData(this);
    let response = await fetch("/tests", {
        method: "POST",
        body: formData,
    });
    if (response.ok) {
        let test = await response.json();
        document.body.style.pointerEvents = "none";
        showFlash("Тест успешно загружен на сервер!", true);
        localStorage.clear();
        setTimeout(() => (location.href = `/tests/${test.id}/publish`), 1000);
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
            element.addEventListener(event, removeErrorDiv);
        }

        this.querySelectorAll(".answerAdder").forEach((item) =>
            item.addEventListener("click", function (e) {
                removeErrorDiv(e);
            })
        );
        function removeErrorDiv(e) {
            let errorDiv = Array.from(
                e.currentTarget.closest(".errorContainer").children
            )
                .find((item) => item.classList.contains("errorDiv"))
                ?.remove();
        }
    } else if (response.status == 502) {
        let message = await response.text();
        showFlash(message.trim(), false);
    }

    function showFlash(message, ok = true) {
        let flash = document.getElementById("flashMessage");
        flash.textContent = message;
        if (ok) {
            flash.classList.add("bg-green-500");
            flash.classList.remove("bg-red-500");
        } else {
            flash.classList.remove("bg-green-500");
            flash.classList.add("bg-red-500");
        }
        flash.hidden = false;
        setTimeout(() => {
            flash.hidden = true;
            flash.innerHTML = "";
        }, 1500);
    }
});
