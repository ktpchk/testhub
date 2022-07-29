class Question {
    constructor(button) {
        const questionTemplate = document.getElementById("questionTemplate");
        let clone = questionTemplate.content.firstElementChild.cloneNode(true);
        this.node = clone;
        this.answers = [];
        this.points = 0;
        this.type = "";
        Question.questions.push(this);

        button.before(clone);

        Question.fillMeta();
        clone.querySelector(".answerAdder").click();
    }

    static destroy(button) {
        let node = button.closest(".question");
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

            let savedType = localStorage.getItem(
                `questions[${question.number}][type]`
            );
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
                .forEach((item) =>
                    item.setAttribute(
                        "name",
                        `questions[${question.number}][type]`
                    )
                );
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
        button.after(clone);

        question.answers.push(this);
        this.question = question;
        this.node = clone;
    }

    static destroy(button) {
        let questionNode = button.closest(".question");
        let node = button.closest(".answer");
        node.remove();

        Question.questions
            .find((item) => item.node == questionNode)
            .answers.forEach((item, index, array) => {
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

    questionNode.querySelectorAll(".answer").forEach((item) => item.remove());
    question.answers.length = 0;

    questionNode.querySelector(".answerAdder").click();
}

document.addEventListener("input", setPoints);
function setPoints(event) {
    let target = event.target.closest('[name$="[points]"]');
    if (!target) return;

    let questionNode = target.closest(".question");
    let question = Question.questions.find((item) => item.node == questionNode);
    question.points = target.value;
}

document.addEventListener("click", function (event) {
    let target = event.target.closest(".resetForm");
    if (!target) return;

    if (confirm("Это действие необратимо. Вы уверены?")) {
        localStorage.clear();
        location.reload();
    }
});

if (localStorage.length == 0) {
    document.querySelector(".questionAdder").click();
}
