const totalQuestions = document.getElementById("totalQuestions");
const totalPoints = document.getElementById("totalPoints");
const timePerQuestion = document.getElementById("timePerQuestion");
const testTime = document.getElementById("testTime");

document.addEventListener("click", function (event) {
    let target = event.target.closest(".questionAdder,.deleteQuestion");
    if (!target) return;
    render("questions");
    render("time");
});

function render(field) {
    if (typeof Question != "function") return;
    if (field == "all" || field == "questions") {
        totalQuestions.textContent = Question.questions.length ?? 0;
    }
    if (field == "all" || field == "points") {
        totalPoints.textContent =
            Question.questions.reduce((sum, item) => sum + +item.points, 0) ??
            0;
    }
    if (field == "all" || field == "time") {
        timePerQuestion.textContent = Math.round(
            testTime.value / Question.questions.length
        );
    }
}

document.addEventListener("input", function (event) {
    let target = event.target.closest('[name$="[points]"],#testTime');
    if (!target) return;
    if (target.id == "testTime") {
        render("time");
    } else {
        render("points");
    }
});

render("all");

// Sticky Right Panel

let rightPanel = new StickySidebar("#rightPanel", {
    containerSelector: "#stickyContainer",
    innerWrapperSelector: ".sidebar__inner",
    topSpacing: 20,
    bottomSpacing: 20,
});
