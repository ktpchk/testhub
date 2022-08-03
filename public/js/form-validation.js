window.form.addEventListener("submit", async function (e) {
    e.preventDefault();
    // this.submit();
    let formData = new FormData(this);
    let response = await fetch("/tests/store", {
        method: "POST",
        body: formData,
    });
    let result = await response.json();
    console.log(result);
});
