<x-userLayout>
    <div class="max-w-3xl mx-auto mt-8">
        <h2 class="text-2xl font-bold text-center mb-6">Timed Quiz</h2>
        
        <div class="flex justify-between items-center mb-4">
            <div class="text-lg">Time Remaining: <span id="timer" class="font-semibold text-red-500">10</span> seconds</div>
            <button id="exit-btn" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                Exit Quiz
            </button>
        </div>

        <form action="{{ route('quiz.timed.submit') }}" method="POST" id="quiz-form">
            @csrf

            @foreach($questions as $index => $question)
                <div class="question mb-6" data-question-id="{{ $question->id }}">
                    <h3 class="font-semibold text-lg mb-2">{{ $index + 1 }}. {{ $question->question_text }}</h3>

                    @if($question->question_type == 'multiple_choice')
                        <div class="space-y-2">
                            @foreach($question->answers as $answer)
                                <label class="block">
                                    <input type="radio" name="questions[{{ $question->id }}]" value="{{ $answer->id }}" class="mr-2">
                                    {{ $answer->answer_text }}
                                </label>
                            @endforeach
                        </div>
                    @elseif($question->question_type == 'true_false')
                        <div class="space-y-2">
                            <label class="block">
                                <input type="radio" name="questions[{{ $question->id }}]" value="1" class="mr-2">
                                True
                            </label>
                            <label class="block">
                                <input type="radio" name="questions[{{ $question->id }}]" value="0" class="mr-2">
                                False
                            </label>
                        </div>
                    @endif
                </div>
            @endforeach

            <!-- Submit Button -->
            <button type="submit" id="submit-btn" class="bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 w-full mt-4" style="display: none;">
                Submit Quiz
            </button>
        </form>
    </div>

    <!-- Rules Modal -->
    <div id="rules-modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 max-w-md">
            <h3 class="text-xl font-bold mb-4">Timed Quiz Rules</h3>
            <ul class="list-disc pl-5 mb-4">
                <li>You have 10 seconds to answer each question.</li>
                <li>If you don't answer in time, you'll move to the next question.</li>
                <li>Once you move on, you cannot return to previous questions.</li>
            </ul>
            <button id="start-quiz-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Start Quiz
            </button>
        </div>
    </div>

    <script>
    let questions = Array.from(document.querySelectorAll('.question'));
    let timerElement = document.getElementById('timer');
    let currentIndex = 0;
    let timer;

    // Show Rules Modal
    const rulesModal = document.getElementById('rules-modal');
    const startQuizBtn = document.getElementById('start-quiz-btn');
    rulesModal.style.display = 'flex';

    startQuizBtn.addEventListener('click', () => {
        rulesModal.style.display = 'none';
        startQuiz();
    });

    // Exit Quiz Button
    document.getElementById('exit-btn').addEventListener('click', () => {
        window.location.href = "{{ route('users.panel.quiz') }}";
    });

    function startQuiz() {
        showQuestion(currentIndex);
        startTimer();
    }

    function showQuestion(index) {
        questions.forEach((q, i) => {
            q.style.display = i === index ? 'block' : 'none';
        });
    }

    function startTimer() {
        let timeLeft = 10;
        timerElement.textContent = timeLeft;
        timer = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(timer);
                alert('Time out! Moving to next question.');
                nextQuestion();
            }
        }, 1000);
    }

    function nextQuestion() {
        if (currentIndex < questions.length - 1) {
            currentIndex++;
            showQuestion(currentIndex);
            startTimer();
        } else {
            document.getElementById('quiz-form').submit();
        }
    }

    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', () => {
            clearInterval(timer);
            nextQuestion();
        });
    });
    </script>
</x-userLayout>
