const totalQuestions = document.getElementById("totalQuestions");
const totalPoints = document.getElementById("totalPoints");
const timePerQuestion = document.getElementById("timePerQuestion");
const testTime = document.getElementById("testTime");
const navPanel = document.getElementById("navPanel");

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
    renderNavPanel();
}

document.addEventListener("input", function (event) {
    let target = event.target.closest('[name$="[points]"],#testTime');
    if (!target) return;
    render();
});

window.onload = function () {
    render();
};

function renderNavPanel() {
    let container = navPanel.querySelector(".navContainer");
    container.innerHTML = "";
    let questionsCount = Question.questions.length;
    for (let i = 1; i <= questionsCount; i++) {
        let li = document.createElement("li");
        let anchor = document.createElement("a");
        anchor.setAttribute("href", `#question_${i}`);
        anchor.className =
            "w-8 h-8 border-2 border-classicBlue-700 bg-classicBlue-200 hover:bg-classicBlue-700 text-classicPink-300 flex items-center justify-center";
        anchor.textContent = i;
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth",
            });
        });
        li.append(anchor);
        container.append(li);
    }
}

// Sticky Right Panel

let rightPanel = new StickySidebar("#rightPanel", {
    containerSelector: "#stickyContainer",
    innerWrapperSelector: ".sidebar__inner",
    topSpacing: 20,
    bottomSpacing: 20,
});
