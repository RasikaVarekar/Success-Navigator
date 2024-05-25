const quizData = [
    {
      question: 'Who appoints the Chief Justice of India?',
      options: ['The Prime Minister', 'The President', 'The Chief Justice of the Supreme Court', 'The Parliament'],
      answer: 'The President',
    },
    {
      question: ' What is the term duration for the President of India?',
      options: ['3 years', '5 years', '4 years', '6 years'],
      answer: '5 years',
    },
    {
      question: ' What is the preamble of the Indian Constitution?',
      options: ['An introduction', 'The beginning', 'The preface', 'The prologue'],
      answer: 'The preface',
    },
    {
      question: 'How many Fundamental Rights are guaranteed by the Indian Constitution?',
      options: ['4', '8', '6', '9'],
      answer: '6',
    },
    {
      question: 'Who has the power to dissolve the Lok Sabha?',
      options: [
        'Prime Minister',
        'President',
        'Speaker of Lok Sabha',
        'Chief Justice of India',
      ],
      answer: 'President',
    },
    {
      question: 'Which part of the Constitution deals with the Executive?',
      options: ['Part I', 'Part II', 'Part III', 'Part V'],
      answer: 'Part V',
    },
    {
      question: 'Who is the head of the State Government in a state of India?',
      options: [
        'Chief Minister',
        'Governor',
        'President',
        'Prime Minister',
      ],
      answer: 'Chief Minister',
    },
   
    {
      question: 'Which constitutional amendment lowered the voting age from 21 to 18?',
      options: [
        '42nd Amendment',
        '44th Amendment',
        '61st Amendment',
        '73rd Amendment',
      ],
      answer: '61st Amendment',
    },
    {
      question: 'The Comptroller and Auditor General (CAG) of India is appointed by:',
      options: ['President', 'Prime Minister', 'Chief Justice of India', 'Parliament'],
      answer: 'resident',
    },
  ];
  
  const quizContainer = document.getElementById('quiz');
  const resultContainer = document.getElementById('result');
  const submitButton = document.getElementById('submit');
  const retryButton = document.getElementById('retry');
  const showAnswerButton = document.getElementById('showAnswer');
  
  let currentQuestion = 0;
  let score = 0;
  let incorrectAnswers = [];
  
  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
  }
  
  function displayQuestion() {
    const questionData = quizData[currentQuestion];
  
    const questionElement = document.createElement('div');
    questionElement.className = 'question';
    questionElement.innerHTML = questionData.question;
  
    const optionsElement = document.createElement('div');
    optionsElement.className = 'options';
  
    const shuffledOptions = [...questionData.options];
    shuffleArray(shuffledOptions);
  
    for (let i = 0; i < shuffledOptions.length; i++) {
      const option = document.createElement('label');
      option.className = 'option';
  
      const radio = document.createElement('input');
      radio.type = 'radio';
      radio.name = 'quiz';
      radio.value = shuffledOptions[i];
  
      const optionText = document.createTextNode(shuffledOptions[i]);
  
      option.appendChild(radio);
      option.appendChild(optionText);
      optionsElement.appendChild(option);
    }
  
    quizContainer.innerHTML = '';
    quizContainer.appendChild(questionElement);
    quizContainer.appendChild(optionsElement);
  }
  
  function checkAnswer() {
    const selectedOption = document.querySelector('input[name="quiz"]:checked');
    if (selectedOption) {
      const answer = selectedOption.value;
      if (answer === quizData[currentQuestion].answer) {
        score++;
      } else {
        incorrectAnswers.push({
          question: quizData[currentQuestion].question,
          incorrectAnswer: answer,
          correctAnswer: quizData[currentQuestion].answer,
        });
      }
      currentQuestion++;
      selectedOption.checked = false;
      if (currentQuestion < quizData.length) {
        displayQuestion();
      } else {
        displayResult();
      }
    }
  }
  
  function displayResult() {
    quizContainer.style.display = 'none';
    submitButton.style.display = 'none';
    retryButton.style.display = 'inline-block';
    showAnswerButton.style.display = 'inline-block';
    resultContainer.innerHTML = `You scored ${score} out of ${quizData.length}!`;
  }
  
  function retryQuiz() {
    currentQuestion = 0;
    score = 0;
    incorrectAnswers = [];
    quizContainer.style.display = 'block';
    submitButton.style.display = 'inline-block';
    retryButton.style.display = 'none';
    showAnswerButton.style.display = 'none';
    resultContainer.innerHTML = '';
    displayQuestion();
  }
  
  function showAnswer() {
    quizContainer.style.display = 'none';
    submitButton.style.display = 'none';
    retryButton.style.display = 'inline-block';
    showAnswerButton.style.display = 'none';
  
    let incorrectAnswersHtml = '';
    for (let i = 0; i < incorrectAnswers.length; i++) {
      incorrectAnswersHtml += `
        <p>
          <strong>Question:</strong> ${incorrectAnswers[i].question}<br>
          <strong>Your Answer:</strong> ${incorrectAnswers[i].incorrectAnswer}<br>
          <strong>Correct Answer:</strong> ${incorrectAnswers[i].correctAnswer}
        </p>
      `;
    }
  
    resultContainer.innerHTML = `
      <p>You scored ${score} out of ${quizData.length}!</p>
      <p>Incorrect Answers:</p>
      ${incorrectAnswersHtml}
    `;
  }
  
  submitButton.addEventListener('click', checkAnswer);
  retryButton.addEventListener('click', retryQuiz);
  showAnswerButton.addEventListener('click', showAnswer);
  
  displayQuestion();