const form = document.forms.test;
let elements = form.elements;

let savedTestFields = Object.keys(sessionStorage).filter((item) =>
    item.match(/^questions\[\d\]\[answers\]/)
);

let readyTestFields = {};
for (let field of savedTestFields) {
    field = field.split(/[\[\]]/);
    let m = field[1];
    if (!readyTestFields[m]) readyTestFields[m] = 0;
    readyTestFields[m]++;
}
readyTestFields = Object.values(readyTestFields);

for (let question of readyTestFields) {
    document.querySelector(".questionAdder").click();
}
for (let question of Question.questions) {
    for (let i = 1; i < readyTestFields[question.number]; i++) {
        question.node.querySelector(".answerAdder").click();
    }
}

window.onload = function () {
    let oldValues = Object.keys(sessionStorage);
    for (let key of oldValues) {
        // console.log(key, elements[key]?.value);
        if (elements[key]) {
            elements[key].value = sessionStorage.getItem(key);
        }
        // console.log(key, elements[key]?.value);
    }
};

// elements.name.value = sessionStorage.getItem("name");
// elements.tags.value = sessionStorage.getItem("tags");
// elements.time.value = sessionStorage.getItem("time");

// let questions = Question.questions;
// for (let i = 0; i < questions.length; i++) {
//     elements[`questions[${i}][text]`].value = sessionStorage.getItem(
//         `questions[${i}][text]`
//     );
//     elements[`questions[${i}][points]`].value = sessionStorage.getItem(
//         `questions[${i}][points]`
//     );
//     elements[`questions[${i}][type]`].value = sessionStorage.getItem(
//         `questions[${i}][type]`
//     );
// }
setInterval(saveFormData, 15000);
function saveFormData() {
    console.log("saving...");
    sessionStorage.clear();

    let userInputs = new Set();
    for (element of elements) {
        if (element.name) {
            userInputs.add(element.name);
        }
    }
    userInputs = Array.from(userInputs);
    userInputs.shift();

    for (let input of userInputs) {
        sessionStorage.setItem(input, elements[input].value);
    }
}
