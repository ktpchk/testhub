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
    // for (let key in result) {
    //     if (!this.elements[key]) key += "[]";
    //     console.log(key, this.elements[key]);

    //     let error = result[key];
    // console.log(key, error);
    // }
});
