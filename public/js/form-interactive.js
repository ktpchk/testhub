const totalQuestions = document.getElementById("totalQuestions");
const totalPoints = document.getElementById("totalPoints");
const timePerQuestion = document.getElementById("timePerQuestion");
const testTime = document.getElementById("testTime");

document.addEventListener("click", function (event) {
    let target = event.target.closest(".questionAdder,.deleteQuestion");
    if (!target) return;
    render();
});

function render() {
    if (typeof Question != "function") return;
    totalQuestions.textContent = Question.questions.length ?? 0;
    totalPoints.textContent =
        Question.questions.reduce((sum, item) => sum + +item.points, 0) ?? 0;
    timePerQuestion.textContent =
        Math.round(testTime.value / Question.questions.length) ?? 0;
}

document.addEventListener("input", function (event) {
    let target = event.target.closest('[name$="[points]"],#testTime');
    if (!target) return;
    render();
});

window.onload = function () {
    render();
};

// Sticky Right Panel

let rightPanel = new StickySidebar("#rightPanel", {
    containerSelector: "#stickyContainer",
    innerWrapperSelector: ".sidebar__inner",
    topSpacing: 20,
    bottomSpacing: 20,
});
