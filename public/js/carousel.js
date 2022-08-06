const questions = document.querySelectorAll(".question");

document.addEventListener("click", function (e) {
    let button = e.target.closest(".forward,.backward");
    if (!button) return;

    let question = button.closest(".question");
    question.hidden = true;

    if (button.classList.contains("forward")) {
        question.nextElementSibling.hidden = false;
    } else if (button.classList.contains("backward")) {
        question.previousElementSibling.hidden = false;
    }
});
