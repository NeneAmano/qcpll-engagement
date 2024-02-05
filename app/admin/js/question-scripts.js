var questions = document.getElementById('questions');
var questionType = document.getElementById('question-type');
var questionCategory = document.getElementById('question-category');
const url = window.location.pathname.split('/');
console.log(url);

if(url[4] == 'questions.php'){
    questions.classList.add("border");
    questions.classList.add("border-dark");
    questions.classList.add("border-2");
    questions.classList.add("border-opacity-75");
}else if(url[4] == 'question-type.php'){
    questionType.classList.add("border");
    questionType.classList.add("border-dark");
    questionType.classList.add("border-2");
    questionType.classList.add("border-opacity-75");
}else if(url[4] == 'question-category.php'){
    questionCategory.classList.add("border");
    questionCategory.classList.add("border-dark");
    questionCategory.classList.add("border-2");
    questionCategory.classList.add("border-opacity-75");
}