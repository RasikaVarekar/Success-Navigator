document.addEventListener('DOMContentLoaded', function() {
    fetchQuizQuestions();
});

function fetchQuizQuestions() {
    fetch('fetch_quiz_questions.php')
    .then(response => response.json())
    .then(questions => {
        displayQuizQuestions(questions);
    })
    .catch(error => {
        console.error('Error fetching quiz questions:', error);
    });
}

function displayQuizQuestions(questions) {
    const questionContainer = document.getElementById('question-container');
    const optionsContainer = document.getElementById('options-container');

    questions.forEach(question => {
        const questionElement = document.createElement('div');
        questionElement.classList.add('question');
        questionElement.textContent = question.question;
        questionContainer.appendChild(questionElement);

        // Create radio buttons for options
        const options = [question.option1, question.option2, question.option3, question.option4];
        options.forEach((option, index) => {
            const optionElement = document.createElement('div');
            optionElement.classList.add('option');
            optionElement.innerHTML = `<input type="radio" name="question${question.id}" value="${index}"> ${option}`;
            optionsContainer.appendChild(optionElement);
        });
    });
}

function submitResponse() {
    const selectedOptions = Array.from(document.querySelectorAll('input[type="radio"]:checked'));
    const userResponses = selectedOptions.map(option => ({
        questionId: option.name.replace('question', ''),
        selectedOptionIndex: option.value
    }));

    fetch('submit_response.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(userResponses)
    })
    .then(response => response.json())
    .then(result => {
        updateResponseUI(result);
    })
    .catch(error => {
        console.error('Error submitting response:', error);
    });
}

function viewCorrectAnswer() {
    // Implement this function to fetch and display correct answers
    // You can use AJAX to fetch correct answers from the server-side
    // and display them in the UI
}

function updateResponseUI(result) {
    // Implement this function to update the UI based on the response
    // Highlight correct and incorrect answers
    // You can use result data to determine correctness and update the UI accordingly
}