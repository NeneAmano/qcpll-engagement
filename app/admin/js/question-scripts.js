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

// function for adding new input field
function add_status() {
    var new_chq_no = parseInt($('#total_chq_status').val()) + 1;
    var new_input = "<input type='text' id='add_choices_" + new_chq_no + "' name='add_choices[]' class='add_choices" + new_chq_no + " form-control mb-2'>";
    $('#new_chq_status').append(new_input);
    $('#total_chq_status').val(new_chq_no);
}

function remove_status() {
    var last_chq_no = $('#total_chq_status').val();
    if (last_chq_no > 1) {
        $('#add_choices_' + last_chq_no).remove();
        $('#total_chq_status').val(last_chq_no - 1);
    }
}

// function for showing the div of choices
function showfield(name) {
    if (name == '3') document.getElementById('choices').style.display = "block";
    else document.getElementById('choices').style.display = "none";
}

function hidefield() {
    document.getElementById('choices').style.display = 'none';
}