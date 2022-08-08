const navPanel = document.getElementById("navPanel");
const navContainer = navPanel.querySelector(".navContainer");
const questionNodes = document.querySelectorAll(".question");

function findQuestionByNode(node) {
    return Question.questions.find((item) => item.node == node);
}

function renderNav() {
    navContainer.innerHTML = "";

    let questionsCount = Question.questions.length;
    for (let i = 1; i <= questionsCount; i++) {
        let li = document.createElement("li");
        let anchor = document.createElement("a");
        anchor.className =
            "w-8 h-8 border-2 border-classicBlue-700 flex items-center justify-center cursor-pointer";

        let question = Question.questions[i - 1];
        if (question?.isAnswered) {
            anchor.classList.add(
                "bg-classicBlue-300",
                "hover:bg-classicBlue-700",
                "text-white"
            );
        } else {
            anchor.classList.add(
                "bg-white",
                "hover:bg-gray-200",
                "text-classicBlue-700"
            );
        }

        anchor.textContent = i;
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            Question.questions.forEach((item) => (item.node.hidden = true));
            Question.questions[i - 1].node.hidden = false;
            renderNav();
        });
        li.append(anchor);
        navContainer.append(li);
    }
}

class Question {
    constructor(node) {
        this.node = node;
        this.isAnswered = false;
        Question.questions.push(this);
    }
}
Question.questions = [];

document.addEventListener("click", function carousel(e) {
    let button = e.target.closest(".forward,.backward");
    if (!button) return;

    let questionNode = button.closest(".question");
    questionNode.hidden = true;

    if (button.classList.contains("forward")) {
        questionNode.nextElementSibling.hidden = false;
    } else if (button.classList.contains("backward")) {
        questionNode.previousElementSibling.hidden = false;
    }

    renderNav();
});

for (let node of questionNodes) {
    new Question(node);
}

document.forms[0].addEventListener("change", function (e) {
    let answers = Array.from(questionNodes).map((item) =>
        item.querySelectorAll(".answers input")
    );

    for (let answer of answers) {
        findQuestionByNode(answer[0].closest(".question")).isAnswered =
            isValue(answer);
    }

    function isValue(answer) {
        if (answer.length > 1) {
            for (let checkable of answer) {
                if (checkable.checked) return true;
            }
            return false;
        } else {
            return !!answer[0].value;
        }
    }
});

renderNav();
// traceAnswers();
