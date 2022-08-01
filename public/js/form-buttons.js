class Question {
    constructor(button) {
        const questionTemplate = document.getElementById("questionTemplate");
        let clone = questionTemplate.content.firstElementChild.cloneNode(true);
        this.node = clone;
        this.answers = [];
        this.points = 0;
        this.type;
        Question.questions.push(this);

        button.before(clone);

        Question.fillMeta();
        clone.querySelector(".answerAdder").click();
    }

    static destroy(button) {
        let node = button.closest(".question");
        if (Question.questions.length == 1) return;
        node.remove();
        Question.questions.forEach((item, index, array) => {
            if (item.node == node) {
                array.splice(index, 1);
            }
        });
    }

    static fillMeta() {
        for (let i = 0; i < Question.questions.length; i++) {
            let question = Question.questions[i];
            question.number = i;

            let savedType =
                question.type ??
                localStorage.getItem(`questions[${question.number}][type]`);
            question.type = savedType ?? "oneVariant";

            let savedPoints = localStorage.getItem(
                `questions[${question.number}][points]`
            );
            question.points = savedPoints ?? 0;

            let questionNode = question.node;

            questionNode.id = "question_" + (question.number + 1);

            questionNode.querySelector(".questionNumber").textContent =
                question.number + 1;

            questionNode
                .querySelector('[name$="[text]"]')
                .setAttribute("name", `questions[${question.number}][text]`);

            questionNode
                .querySelector('[name$="[points]"]')
                .setAttribute("name", `questions[${question.number}][points]`);

            questionNode
                .querySelectorAll('[name$="[type]"]')
                .forEach(function (item) {
                    item.setAttribute(
                        "name",
                        `questions[${question.number}][type]`
                    );
                    if (item.value == question.type) item.checked = true;
                });
        }
    }
}

Question.questions = [];

class Answer {
    constructor(button) {
        let questionNode = button.closest(".question");
        let question = Question.questions.find(
            (item) => item.node == questionNode
        );

        const answerTemplate = document.getElementById(question.type);
        let clone = answerTemplate.content.firstElementChild.cloneNode(true);
        button.parentNode.append(clone);

        question.answers.push(this);
        this.question = question;
        this.node = clone;
    }

    static destroy(button) {
        let questionNode = button.closest(".question");
        let node = button.closest(".answer");
        let question = Question.questions.find(
            (item) => item.node == questionNode
        );

        if (question.answers.length == 1) return;
        node.remove();
        question.answers.forEach((item, index, array) => {
            if (item.node == node) {
                array.splice(index, 1);
            }
        });
    }

    static fillMeta(questionNode) {
        let answers = Question.questions.find(
            (item) => item.node == questionNode
        ).answers;

        for (let i = 0; i < answers.length; i++) {
            let answer = answers[i];
            answer.number = i;

            let answerNode = answer.node;
            answerNode
                .querySelector('[name$="[correct][]"]')
                ?.setAttribute(
                    "name",
                    `questions[${answer.question.number}][correct][]`
                );
            answerNode
                .querySelector('[name$="[correct]"]')
                ?.setAttribute(
                    "name",
                    `questions[${answer.question.number}][correct]`
                );

            if (answerNode.querySelector('[name*="[correct]"]')) {
                answerNode.querySelector('[name*="[correct]"]').value =
                    answer.number;
            }

            answerNode
                .querySelector('[name$="[text]"]')
                .setAttribute(
                    "name",
                    `questions[${answer.question.number}][answers][${answer.number}][text]`
                );
        }
    }
}

document.addEventListener("click", renderQuestions);
function renderQuestions(event) {
    let target = event.target.closest(".deleteQuestion,.questionAdder");
    if (!target) return;
    if (target.classList.contains("questionAdder")) {
        new Question(target);
    } else if (target.classList.contains("deleteQuestion")) {
        Question.destroy(target);
    }
    Question.fillMeta();
    Question.questions.forEach((item) => Answer.fillMeta(item.node));
}

document.addEventListener("click", renderAnswers);
async function renderAnswers(event) {
    let target = event.target.closest(".answerAdder,.deleteAnswer");
    if (!target) return;

    let question = target.closest(".question");

    if (target.classList.contains("answerAdder")) {
        new Answer(target);
    } else if (target.classList.contains("deleteAnswer")) {
        Answer.destroy(target);
    }
    Answer.fillMeta(question);
}

document.addEventListener("click", selectType);
function selectType(event) {
    let target = event.target.closest('[name$="[type]"]');
    if (!target) return;

    let questionNode = target.closest(".question");
    let question = Question.questions.find((item) => item.node == questionNode);
    question.type = target.value;

    let oldAnswers = question.answers.slice();
    questionNode.querySelectorAll(".answer").forEach((item) => item.remove());
    question.answers.length = 0;

    let textValues = [];
    let answerCounter = 0;
    for (let oldAnswer of oldAnswers) {
        textValues.push(
            oldAnswer.node.querySelector('[name*="[text]"]')?.value
        );
        questionNode.querySelector(".answerAdder").click();
        answerCounter++;
    }

    let newAnswersNodes = questionNode.querySelectorAll(".answer");
    for (let i = 0; i < answerCounter; i++) {
        newAnswersNodes[i].querySelector('[name*="[text]"]').value =
            textValues[i];
    }
}

document.addEventListener("input", setPoints);
function setPoints(event) {
    let target = event.target.closest('[name$="[points]"]');
    if (!target) return;

    let questionNode = target.closest(".question");
    let question = Question.questions.find((item) => item.node == questionNode);
    question.points = target.value;
}

document.addEventListener("click", function (e) {
    let target = e.target.closest(".moveUp,.moveDown");
    if (!target) return;
    let questionNode = target.closest(".question");
    if (target.classList.contains("moveUp")) {
        moveNode(questionNode, "up");
    } else if (target.classList.contains("moveDown")) {
        moveNode(questionNode, "down");
    }
    questionNode.scrollIntoView({
        behavior: "smooth",
    });
});
function moveNode(node, direction) {
    let questions = Question.questions;
    let question = questions.find((item) => item.node == node);
    let node2;
    let tmp;
    switch (direction) {
        case "up":
            if (question.number == 0) return;

            node2 = node.previousElementSibling;
            node2.before(node);

            tmp = questions[question.number];
            questions[question.number] = questions[question.number - 1];
            questions[question.number - 1] = tmp;
            break;

        case "down":
            if (question.number == questions.length - 1) return;

            node2 = node.nextElementSibling;
            node2.after(node);

            tmp = questions[question.number];
            questions[question.number] = questions[question.number + 1];
            questions[question.number + 1] = tmp;
            break;
    }
    Question.fillMeta();
}

document.addEventListener("click", function (e) {
    let target = e.target.closest("#descriptionAdder,#descriptionDelete");
    if (!target) return;

    if (target.id == "descriptionAdder") {
        let descriptionContainer = document.createElement("div");
        descriptionContainer.id = "descriptionContainer";

        let descriptionArea = document.createElement("textarea");
        descriptionArea.value =
            window.description ?? localStorage.getItem("description");
        descriptionArea.name = "description";
        descriptionArea.className =
            "w-full p-2 border-2 rounded-sm outline-none";
        descriptionArea.rows = 4;
        descriptionArea.placeholder = "Предисловие...";

        descriptionArea.addEventListener("input", function (e) {
            window.description = this.value;
        });

        descriptionContainer.append(descriptionArea);

        target.parentNode.parentNode.after(descriptionContainer);
        target.textContent = "Убрать предисловие";
        target.id = "descriptionDelete";
    } else if (target.id == "descriptionDelete") {
        document.getElementById("descriptionContainer").remove();
        target.textContent = "Добавить предисловие";
        target.id = "descriptionAdder";
    }
});

document.addEventListener("click", function (e) {
    let target = e.target.closest("#deleteTestTime,#addTestTime");
    if (!target) return;

    if (target.id == "deleteTestTime") {
        let testTime = document.getElementById("testTime");
        let div = document.createElement("div");
        div.innerHTML = '<i class="fa-solid fa-infinity"></i>';
        div.className =
            "border-2 rounded-sm w-11 bg-gray-100 py-0.5 flex justify-center";
        div.id = "testTimePlaceholder";

        testTime.replaceWith(div);

        target.textContent = "Добавить";
        target.id = "addTestTime";
    } else if (target.id == "addTestTime") {
        let testTimePlaceholder = document.getElementById(
            "testTimePlaceholder"
        );

        let input = document.createElement("input");
        input.type = "number";
        input.className = "border-2 rounded-sm outline-none w-11";
        input.min = 0;
        input.max = 999;
        input.name = "time";
        input.id = "testTime";
        input.value = window.testTime ?? +localStorage.getItem("time") ?? 0;

        input.addEventListener("input", function (e) {
            window.testTime = this.value;
        });

        window.testTime = input.value;
        testTimePlaceholder.replaceWith(input);

        target.textContent = "Убрать";
        target.id = "deleteTestTime";
    }
});

if (localStorage.length == 0) {
    document.querySelector(".questionAdder").click();
}
